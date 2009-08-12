@echo off
call :checkinstances

for /l %%i in (1,1,10) do call :loop %%i
goto :eof

:loop

if %INSTANCES% LSS 5 (
    rem just a dummy program that waits instead of doing useful stuff
    rem but suffices for now
    echo Starting processing instance for %1
    start /i /min "Process %1" "php" "extension\benchmark\bin\benchmark.php" "--class=65" "--count=100 "--nodes=12"
    rem " -a -f extension\benchmark\bin\benchmark.php --class=65 --count=100 --nodes=12"
    goto :eof
)
rem wait a second, can be adjusted with -w (-n 2 because the first ping returns immediately;
rem otherwise just use an address that's unused and -n 1)
echo Waiting for instances to close ...
ping -n 2 ::1 >nul 2>&1
rem jump back to see whether we can spawn a new process now
goto loop
goto :eof

:checkinstances
rem this could probably be done better. But INSTANCES should contain the number of running instances afterwards.
for /f "usebackq" %%t in (`tasklist /fo csv /fi "imagename eq wait.exe"^|wc -l`) do set INSTANCES=%%t
goto :eof


rem php extension\benchmark\bin\benchmark.php --class=65 --count=100 --nodes=12