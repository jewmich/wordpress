#!/bin/bash

set -e

ssh -C jewmich_com@jewmich.com 'mysqldump -p -u jewmichwordpress -h mysql.jewmich.com jewmichmainsql' > dump.sql
sed -i 's/DEFINER=[^*]*\*/\*/g' dump.sql
echo 'UPDATE wp_options set option_value = "http://127.0.0.1" where option_value = "https://www.jewmich.com";' >> dump.sql
echo 'UPDATE wp_usermeta set meta_value = "disabled" where meta_key = "googleauthenticator_enabled";' >> dump.sql
mysql -u root -pwordpress -h 127.0.0.1 jewmichmainsql < dump.sql
