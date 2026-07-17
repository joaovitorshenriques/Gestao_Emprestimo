@echo off
cd /d "%~dp0"
"C:\php\php.exe" artisan serve --host=127.0.0.1 --port=8000 > "storage\logs\laravel-server.log" 2>&1
