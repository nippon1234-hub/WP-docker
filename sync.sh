#!/bin/bash
# WordPress Docker 同期ツール（Mac/Linux版）

# 色付き出力用
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# ===========================================
# 1. 初期セットアップ
# ===========================================
setup() {
    echo -e "${BLUE}=====================================${NC}"
    echo -e "${YELLOW}🛠️ 初期セットアップを開始します...${NC}"
    echo -e "${BLUE}=====================================${NC}"
    
    docker-compose up -d
    
    echo -e "${YELLOW}⏰ データベースの起動を待機中...${NC}"
    sleep 15
    
    echo -e "${GREEN}✅ セットアップ完了！${NC}"
    echo -e "${BLUE}📱 WordPress: http://localhost:8080${NC}"
    echo -e "${BLUE}🗄️ phpMyAdmin: http://localhost:8081${NC}"
}

# ===========================================
# 2. データベースエクスポート
# ===========================================
export_db() {
    echo -e "${BLUE}=====================================${NC}"
    echo -e "${YELLOW}📦 データベースをエクスポート中...${NC}"
    echo -e "${BLUE}=====================================${NC}"
    
    # sql-exportディレクトリを作成
    mkdir -p sql-export
    
    echo -e "${YELLOW}データベース接続を確認中...${NC}"
    if docker-compose exec db mysql -u wordpress -pwordpress -e "SELECT 1;" >/dev/null 2>&1; then
        echo -e "${GREEN}✅ wordpressユーザーで接続成功${NC}"
        docker-compose exec db mysqldump -u wordpress -pwordpress wordpress > sql-export/wordpress-latest.sql
    else
        echo -e "${YELLOW}⚠️ wordpressユーザーで接続できません。rootユーザーを試行中...${NC}"
        docker-compose exec db mysqldump -u root -prootpassword wordpress > sql-export/wordpress-latest.sql
    fi
    
    if [ -s sql-export/wordpress-latest.sql ]; then
        echo -e "${GREEN}✅ エクスポート完了: sql-export/wordpress-latest.sql${NC}"
        return 0
    else
        echo -e "${RED}❌ エクスポートに失敗しました${NC}"
        return 1
    fi
}

# ===========================================
# 3. データベースインポート
# ===========================================
import_db() {
    echo -e "${BLUE}=====================================${NC}"
    echo -e "${YELLOW}📥 データベースをインポート中...${NC}"
    echo -e "${BLUE}=====================================${NC}"
    
    if [ ! -f "sql-export/wordpress-latest.sql" ]; then
        echo -e "${RED}❌ エラー: sql-export/wordpress-latest.sql が見つかりません${NC}"
        return 1
    fi
    
    echo -e "${YELLOW}データベース接続を確認中...${NC}"
    if docker-compose exec db mysql -u wordpress -pwordpress -e "SELECT 1;" >/dev/null 2>&1; then
        echo -e "${GREEN}✅ wordpressユーザーで接続成功${NC}"
        echo -e "${YELLOW}データベースをリセットしています...${NC}"
        docker-compose exec db mysql -u wordpress -pwordpress -e "DROP DATABASE IF EXISTS wordpress; CREATE DATABASE wordpress;"
        echo -e "${YELLOW}データをインポートしています...${NC}"
        docker-compose exec -T db mysql -u wordpress -pwordpress wordpress < sql-export/wordpress-latest.sql
    else
        echo -e "${YELLOW}⚠️ wordpressユーザーで接続できません。rootユーザーを使用...${NC}"
        echo -e "${YELLOW}データベースをリセットしています...${NC}"
        docker-compose exec db mysql -u root -prootpassword -e "DROP DATABASE IF EXISTS wordpress; CREATE DATABASE wordpress; GRANT ALL PRIVILEGES ON wordpress.* TO 'wordpress'@'%';"
        echo -e "${YELLOW}データをインポートしています...${NC}"
        docker-compose exec -T db mysql -u root -prootpassword wordpress < sql-export/wordpress-latest.sql
    fi
    
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}✅ インポート完了${NC}"
        return 0
    else
        echo -e "${RED}❌ インポートに失敗しました${NC}"
        return 1
    fi
}

# ===========================================
# 4. 完全同期（プッシュ）
# ===========================================
full_sync_push() {
    echo -e "${BLUE}=====================================${NC}"
    echo -e "${YELLOW}🚀 完全同期を開始（プッシュ）...${NC}"
    echo -e "${BLUE}=====================================${NC}"
    
    # データベースエクスポート
    if ! export_db; then
        return 1
    fi
    
    echo -e "${YELLOW}📁 アップロードファイル（画像）を含めて同期中...${NC}"
    git add .
    
    # アップロードされた画像ファイル数を表示
    image_count=$(find wp-content/uploads -type f \( -name "*.jpg" -o -name "*.jpeg" -o -name "*.png" -o -name "*.gif" -o -name "*.webp" \) 2>/dev/null | wc -l)
    echo -e "${BLUE}画像ファイル数: ${image_count}${NC}"
    
    echo -e "${YELLOW}Gitにコミットしています...${NC}"
    timestamp=$(date '+%Y-%m-%d %H:%M:%S')
    git commit -m "WordPress sync (画像含む): ${timestamp}"
    git push origin main
    
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}✅ 同期完了！画像も含めて他のPCで './sync.sh pull' を実行してください${NC}"
    else
        echo -e "${RED}❌ Git同期に失敗しました${NC}"
    fi
}

# ===========================================
# 5. 完全同期（プル）
# ===========================================
full_sync_pull() {
    echo -e "${BLUE}=====================================${NC}"
    echo -e "${YELLOW}📥 完全同期を開始（プル）...${NC}"
    echo -e "${BLUE}=====================================${NC}"
    
    echo -e "${YELLOW}Gitから最新を取得しています...${NC}"
    git pull origin main
    
    echo -e "${YELLOW}Dockerコンテナを再起動しています...${NC}"
    docker-compose down
    docker-compose up -d
    
    echo -e "${YELLOW}⏰ データベースの起動を待機中...${NC}"
    sleep 10
    
    import_db
    echo -e "${GREEN}✅ 同期完了！WordPressにアクセスできます${NC}"
}

# ===========================================
# 6. メニュー表示
# ===========================================
show_menu() {
    echo -e "${BLUE}======================================${NC}"
    echo -e "${YELLOW}WordPress Docker 同期ツール (Mac版)${NC}"
    echo -e "${BLUE}======================================${NC}"
    echo -e "${GREEN}1. 初期セットアップ     : ./sync.sh setup${NC}"
    echo -e "${GREEN}2. DBエクスポート      : ./sync.sh export${NC}"
    echo -e "${GREEN}3. DBインポート        : ./sync.sh import${NC}"
    echo -e "${GREEN}4. 完全同期（送信）     : ./sync.sh push${NC}"
    echo -e "${GREEN}5. 完全同期（受信）     : ./sync.sh pull${NC}"
    echo -e "${BLUE}======================================${NC}"
    echo ""
    echo -e "${NC}使用方法: ./sync.sh [setup|export|import|push|pull]${NC}"
}

# ===========================================
# メイン処理
# ===========================================
case "$1" in
    "setup")
        setup
        ;;
    "export")
        export_db
        ;;
    "import")
        import_db
        ;;
    "push")
        full_sync_push
        ;;
    "pull")
        full_sync_pull
        ;;
    *)
        show_menu
        ;;
esac