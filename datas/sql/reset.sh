#!/bin/bash

mysql -u root --password=thierry1971 < 00_drop_db_hotel.sql
mysql -u root --password=thierry1971 < 01_init_hotel.sql
mysql -u root --password=thierry1971 < 10_struct_hotel.sql
mysql -u root --password=thierry1971 < 15_triggers_hotel.sql
mysql -u root --password=thierry1971 < 20_datas_test_hotel.sql
