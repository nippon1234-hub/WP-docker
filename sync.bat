@echo off
chcp 65001 >nul
:: WordPress Docker 同期ツール（Windows版）

if "%~1"=="" goto show_menu
if "%~1"=="setup" goto setup
if "%~1"=="export" goto export_db
if "%~1"=="import" goto import_db
if "%~1"=="push" goto full_sync_push
if "%~1"=="pull" goto full_sync_pull
goto show_menu

:setup
echo ====================================
echo 🛠️ 初期セットアップを開始します...
echo ====================================
docker-compose up -d
echo ⏰ データベースの起動を待機中...
timeout /t 15 /nobreak >nul
echo ✅ セットアップ完了！
echo 📱 WordPress: http://localhost:8080
echo 🗄️ phpMyAdmin: http://localhost:8081
goto end

:export_db
echo ====================================
echo 📦 データベースをエクスポート中...
echo ====================================
if not exist "sql-export" mkdir sql-export
docker-compose exec -T db mysqldump -h localhost -u wordpress -pwordpress wordpress > sql-export\wordpress-latest.sql
if %errorlevel% equ 0 (
    echo ✅ エクスポート完了: sql-export\wordpress-latest.sql
) else (
    echo ❌ エクスポートに失敗しました
    echo 代替方法を試行中...
    docker-compose exec db sh -c "mysqldump -h localhost -u wordpress -pwordpress wordpress" > sql-export\wordpress-latest.sql
)
goto end

:import_db
echo ====================================
echo 📥 データベースをインポート中...
echo ====================================
if not exist "sql-export\wordpress-latest.sql" (
    echo ❌ エラー: sql-export\wordpress-latest.sql が見つかりません
    goto end
)
echo データベースをリセットしています...
docker-compose exec -T db mysql -h localhost -u wordpress -pwordpress -e "DROP DATABASE IF EXISTS wordpress; CREATE DATABASE wordpress;"
echo データをインポートしています...
docker-compose exec -T db mysql -h localhost -u wordpress -pwordpress wordpress < sql-export\wordpress-latest.sql
if %errorlevel% equ 0 (
    echo ✅ インポート完了
) else (
    echo ❌ インポートに失敗しました
)
goto end

:full_sync_push
echo ====================================
echo 🚀 完全同期を開始（プッシュ）...
echo ====================================
call :export_db
if %errorlevel% neq 0 goto end

echo Gitにコミットしています...
git add .
git commit -m "WordPress sync: %date% %time%"
git push origin main

if %errorlevel% equ 0 (
    echo ✅ 同期完了！他のPCで 'sync.bat pull' を実行してください
) else (
    echo ❌ Git同期に失敗しました
)
goto end

:full_sync_pull
echo ====================================
echo 📥 完全同期を開始（プル）...
echo ====================================
echo Gitから最新を取得しています...
git pull origin main

echo Dockerコンテナを再起動しています...
docker-compose down
docker-compose up -d

echo ⏰ データベースの起動を待機中...
timeout /t 10 /nobreak >nul

call :import_db
echo ✅ 同期完了！WordPressにアクセスできます
goto end

:show_menu
echo ======================================
echo WordPress Docker 同期ツール (Windows版)
echo ======================================
echo 1. 初期セットアップ     : sync.bat setup
echo 2. DBエクスポート      : sync.bat export
echo 3. DBインポート        : sync.bat import
echo 4. 完全同期（送信）     : sync.bat push
echo 5. 完全同期（受信）     : sync.bat pull
echo ======================================
echo.
echo 使用方法: sync.bat [setup^|export^|import^|push^|pull]
goto end

:end
pause