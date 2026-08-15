@echo off
TITLE Severus Cues - Start Development Mode
echo ========================================================
echo               SEVERUS CUES - VENOM DEV ON                
echo ========================================================
echo Starting Docker containers (DB, Backend PHP, Frontend Nginx)...
echo.

docker compose up -d --build

echo.
echo Waiting for Database and Backend containers to initialize...
timeout /t 5 /nobreak > nul

echo Running migrations and seeders...
docker compose exec -T backend php artisan migrate --force
docker compose exec -T backend php artisan db:seed --force

echo.
echo ========================================================
echo  SEVERUS CUES IS NOW LIVE!
echo  ------------------------------------------------------
echo  Customer Landing Page: http://localhost:8000
echo  Inside Team Portal:    http://localhost:8000/admin
echo  Tokopedia Store Link:  https://www.tokopedia.com/severus
echo ========================================================
echo.
pause
