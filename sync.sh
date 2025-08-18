#!/bin/bash
# WordPress Docker データベース同期スクリプト

# ===========================================
# 1. データベースエクスポート（元のPC用）
# ===========================================

export_db() {
    echo "📦 データベースをエクスポートしています..."
    
    # SQLディレクトリを作成
    mkdir -p sql-export
    
    # データベースをエクスポート
    docker-compose exec db mysqldump \
        -u wordpress \
        -pwordpress \
        wordpress > sql-export/wordpress-$(date +%Y%m%d-%H%M%S).sql
    
    # 最新版も作成
    docker-compose exec db mysqldump \
        -u wordpress \
        -pwordpress \
        wordpress > sql-export/wordpress-latest.sql
    
    echo "✅ エクスポート完了: sql-export/wordpress-latest.sql"
}

# ===========================================
# 2. データベースインポート（新しいPC用）
# ===========================================

import_db() {
    echo "📥 データベースをインポートしています..."
    
    if [ ! -f "sql-export/wordpress-latest.sql" ]; then
        echo "❌ エラー: sql-export/wordpress-latest.sql が見つかりません"
        exit 1
    fi
    
    # データベースをリセットしてインポート
    docker-compose exec db mysql \
        -u wordpress \
        -pwordpress \
        -e "DROP DATABASE IF EXISTS wordpress; CREATE DATABASE wordpress;"
    
    docker-compose exec -T db mysql \
        -u wordpress \
        -pwordpress \
        wordpress < sql-export/wordpress-latest.sql
    
    echo "✅ インポート完了"
}

# ===========================================
# 3. 完全同期（ファイル + DB）
# ===========================================

full_sync_push() {
    echo "🚀 完全同期を開始します（プッシュ）..."
    
    # 1. データベースエクスポート
    export_db
    
    # 2. Gitにコミット
    git add .
    git commit -m "WordPress sync: $(date '+%Y-%m-%d %H:%M:%S')"
    git push origin main
    
    echo "✅ 同期完了！他のPCでfull_sync_pullを実行してください"
}

full_sync_pull() {
    echo "📥 完全同期を開始します（プル）..."
    
    # 1. Gitから最新を取得
    git pull origin main
    
    # 2. Dockerコンテナを再起動
    docker-compose down
    docker-compose up -d
    
    # 3. データベースが起動するまで待機
    echo "⏰ データベースの起動を待機中..."
    sleep 10
    
    # 4. データベースインポート
    import_db
    
    echo "✅ 同期完了！WordPressにアクセスできます"
}

# ===========================================
# 4. 初期セットアップ
# ===========================================

setup() {
    echo "🛠️ 初期セットアップを開始します..."
    
    # docker-composeでサービス起動
    docker-compose up -d
    
    # データベース起動待機
    sleep 15
    
    echo "✅ セットアップ完了！"
    echo "📱 WordPress: http://localhost:8080"
    echo "🗄️ phpMyAdmin: http://localhost:8081"
}

# ===========================================
# メニュー
# ===========================================

show_menu() {
    echo "======================================"
    echo "WordPress Docker 同期ツール"
    echo "======================================"
    echo "1. セットアップ (setup)"
    echo "2. DBエクスポート (export)"
    echo "3. DBインポート (import)"
    echo "4. 完全同期プッシュ (push)"
    echo "5. 完全同期プル (pull)"
    echo "======================================"
}

# コマンドライン引数処理
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
        echo "使用方法: ./sync.sh [setup|export|import|push|pull]"
        ;;
esac