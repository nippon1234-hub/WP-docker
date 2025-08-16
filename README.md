# WordPress Docker開発環境

## 概要
このプロジェクトは、DockerとDocker Composeを使用したWordPress開発環境です。

## 必要な環境
- Docker Desktop
- Git

## セットアップ手順

### 1. リポジトリのクローン
```bash
git clone [このリポジトリのURL]
cd wordpress-project
```

### 2. 環境変数の設定
```bash
# .env.exampleを.envにコピー
cp .env.example .env

# .envファイルを編集してパスワードなどを設定
# Windows: notepad .env
# Mac/Linux: nano .env
```

### 3. Docker環境の起動
```bash
# バックグラウンドで起動
docker compose up -d

# ログを確認しながら起動（初回推奨）
docker compose up
```

### 4. アクセス確認
- **WordPress管理画面**: http://localhost:8080/wp-admin/
- **WordPress サイト**: http://localhost:8080/
- **phpMyAdmin**: http://localhost:8081/

## 開発の流れ

### テーマのカスタマイズ
```bash
# カスタムテーマフォルダに移動
cd wp-content/themes/your-theme/

# ファイルを編集
# 変更は即座にサイトに反映されます
```

### 変更のコミット
```bash
# 変更を確認
git status

# 変更を追加
git add .

# コミット
git commit -m "機能追加: XXXを実装"

# リモートリポジトリにプッシュ
git push origin main
```

## よく使用するコマンド

### Docker操作
```bash
# コンテナの状態確認
docker compose ps

# 環境の停止
docker compose stop

# 環境の完全削除
docker compose down -v

# ログの確認
docker compose logs wordpress
```

### WordPress操作
```bash
# WordPressにアクセス
open http://localhost:8080

# phpMyAdminにアクセス
open http://localhost:8081
```

## ディレクトリ構成
```
wordpress-project/
├── docker-compose.yml    # Docker設定
├── uploads.ini          # PHP設定
├── .env.example         # 環境変数例
├── .env                 # 環境変数（Git管理外）
├── .gitignore          # Git除外設定
├── README.md           # このファイル
└── wp-content/         # WordPressカスタマイズ
    ├── themes/         # カスタムテーマ
    └── plugins/        # カスタムプラグイン
```

## トラブルシューティング

### ポートが使用中の場合
`.env`ファイルのポート番号を変更してください：
```env
WORDPRESS_PORT=8090
PHPMYADMIN_PORT=8091
```

### データベース接続エラー
```bash
# データベースコンテナの再起動
docker compose restart db
```

## 貢献方法
1. ブランチを作成: `git checkout -b feature/new-feature`
2. 変更をコミット: `git commit -am 'Add some feature'`
3. ブランチにプッシュ: `git push origin feature/new-feature`
4. プルリクエストを作成

## ライセンス
このプロジェクトはMITライセンスの下で公開されています。