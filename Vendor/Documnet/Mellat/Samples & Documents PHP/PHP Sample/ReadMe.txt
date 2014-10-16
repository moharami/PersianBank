To support ssl:
 
1) remove ';' from extension=php_curl.dll in php.ini
2) ensure that  ssleay32.dll and libeay32.dll are in Windows/system32.
3) Copy php_curl.dll into Windows\System32 as well.