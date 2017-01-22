<?php

// Development-mode secrets. Production-mode are outside version control for security

// The name of the database for WordPress
define('DB_NAME', 'jewmichmainsql');
// MySQL database username
define('DB_USER', 'wordpress');
// MySQL database password
define('DB_PASSWORD', 'wordpress');
// MySQL hostname
define('DB_HOST', 'db:3306');

// Authentication Unique Keys and Salts.
define('AUTH_KEY',         '0R eZJi?dv9#wXM&N6+!yD@5=Z:fd5ui;us;G2b_*U*:>{7VA5BE>Jnp2sb;UH4Q');
define('SECURE_AUTH_KEY',  '$B-,$bcT/bg|h#=C(gfr]SR7&nz_I~U_mwP^dpf|c(d|owBV.H* !kd|w4_x[<-/');
define('LOGGED_IN_KEY',    'jWPo*AGG7`Pux+@,PSnFH$t8stEIb:(0~?I#CAC$px#`|s+.rRbMB54+zz>l[3kM');
define('NONCE_KEY',        '?.dK8m]6Gv))^)!iHHp89|W*m.0OTy-[ww[g:yd;#O/r-8w3x3QpA7Y%-6uw:o#J');
define('AUTH_SALT',        '#Q9b(rvZb^YMR7+S;~|-J=-VY65|;~qr+uI;oOe?e}-)7a3Pluo^mR_~6)!GjC![');
define('SECURE_AUTH_SALT', 'n9t(rs.RJEj`%2M0Kru(_V-^5+`1F#Y[OU^)|1NCmp6&&sE%Jb{2LHfYAj1>Wxrd');
define('LOGGED_IN_SALT',   'u3[gV.k(g1hiGpeokYv?-c$z=G7;!.qF(WihlSqAW B%:dcM6^kY|9CSO<uVFHLt');
define('NONCE_SALT',       '`fIBz`@WOy$-9PO^LNU9G-=?.f[!3R1_93Yo%YklY88]|W(xMT]~?,I#7az7%!(G');

// Jewmich-specific secrets
define('SMTP_USERNAME', 'localhost');
define('SMTP_PASSWORD', '');
define('RESET_LINK_SALT', 'foobar');
