#!/bin/sh
allargs=$@
if [ $# -eq 0  ];then
    echo "Usage:  $0 http://www.example.com"
    exit 0
fi
sign="E5B23889C6609EF2E1321F5236F89D0129A01D5D"
echo $# "total argument"
cmdexe="env http --pretty format -f post $allargs  sign=$sign User-Agent:convee-admin-ua "
echo $cmdexe
($cmdexe)
