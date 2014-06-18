<?php

define('UC_CONNECT', 'mysql');				// ���� UCenter �ķ�ʽ: mysql/NULL, Ĭ��Ϊ��ʱΪ fscoketopen()
							// mysql ��ֱ�����ӵ���ݿ�, Ϊ��Ч��, ������� mysql

//��ݿ���� (mysql ����ʱ, ����û������ UC_DBLINK ʱ, ��Ҫ�������±���)
define('UC_DBHOST', 'localhost');			// UCenter ��ݿ�����
define('UC_DBUSER', 'root');				// UCenter ��ݿ��û���
define('UC_DBPW', '');					// UCenter ��ݿ�����
define('UC_DBNAME', 'qphpbbs');				// UCenter ��ݿ����
define('UC_DBCHARSET', 'utf8');				// UCenter ��ݿ��ַ�
define('UC_DBTABLEPRE', '`qphpbbs`.smlip_ucenter_');			// UCenter ��ݿ��ǰ׺
define('UC_BBS_DBTABLEPRE', '`qphpbbs`.smlip_');

//ͨ�����
define('UC_KEY', 'gdbnyasdezuhaj9sfbo26yo5b31yz2yo');				// �� UCenter ��ͨ����Կ, Ҫ�� UCenter ����һ��
define('UC_API', 'http://bbs.q.com/uc_server');	// UCenter �� URL ��ַ, �ڵ���ͷ��ʱ�����˳���
define('UC_CHARSET', 'utf-8');				// UCenter ���ַ�
define('UC_IP', '127.0.0.29');					// UCenter �� IP, �� UC_CONNECT Ϊ�� mysql ��ʽʱ, ���ҵ�ǰӦ�÷�������������������ʱ, �����ô�ֵ
define('UC_APPID', 11);					// ��ǰӦ�õ� ID
define('UC_PPP', '20');

//ucexample_2.php �õ���Ӧ�ó�����ݿ����Ӳ���
$dbhost = 'localhost';			// ��ݿ������
$dbuser = 'root';			// ��ݿ��û���
$dbpw = '';				// ��ݿ�����
$dbname = 'qphpbbs';			// ��ݿ���
$pconnect = 0;				// ��ݿ�־����� 0=�ر�, 1=��
$tablepre = '`qphpbbs`.smlip_ucenter_';   		// ����ǰ׺, ͬһ��ݿⰲװ�����̳���޸Ĵ˴�
$dbcharset = 'utf8';			// MySQL �ַ�, ��ѡ 'gbk', 'big5', 'utf8', 'latin1', ����Ϊ������̳�ַ��趨

//ͬ����¼ Cookie ����
$cookiedomain = ''; 			// cookie ������
$cookiepath = '/';			// cookie ����·��