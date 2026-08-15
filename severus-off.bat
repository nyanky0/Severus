@echo off
TITLE Severus Cues - Stop Development Mode
echo ========================================================
echo               SEVERUS CUES - GAMING MODE ON             
echo ========================================================
echo Stopping all Docker containers for Severus Cues...
echo.

docker compose down

echo.
echo ========================================================
echo  All Severus Cues containers have been stopped!
echo  100%% CPU and RAM have been restored for gaming.
echo ========================================================
echo.
pause
