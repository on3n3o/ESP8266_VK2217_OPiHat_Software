#!/bin/bash

stty -F /dev/ttyS1 115200 raw -echo   #CONFIGURE SERIAL PORT
exec 3</dev/ttyS1                     #REDIRECT SERIAL OUTPUT TO FD 3
  cat <&3 > /home/marcin/scripts/ttyDump.dat &          #REDIRECT SERIAL OUTPUT TO FILE
  PID=$!                                #SAVE PID TO KILL CAT
    echo -e "AT+CWLAP\\r\\n" > /dev/ttyS1             #SEND COMMAND STRING TO SERIAL PORT
    sleep 8s                          #WAIT FOR RESPONSE
  kill $PID                             #KILL CAT PROCESS
exec 3<&-                               #FREE FD 3
# cat /home/marcin/scrap/ttyDump.dat                    #DUMP CAPTURED DATA
