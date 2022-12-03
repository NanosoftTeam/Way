<?php

use dokuwiki\PassHash;

/**
 * Class PassHash_test
 *
 * most tests are in auth_password.test.php
 */
class PassHash_test extends DokuWikiTest {

    function test_hmac(){
        // known hashes taken from https://code.google.com/p/yii/issues/detail?id=1942
        $this->assertEquals('df08aef118f36b32e29d2f47cda649b6', PassHash::hmac('md5','data','secret'));
        $this->assertEquals('9818e3306ba5ac267b5f2679fe4abd37e6cd7b54', PassHash::hmac('sha1','data','secret'));

        // known hashes from https://en.wikipedia.org/wiki/Hash-based_message_authentication_code
        $this->assertEquals('74e6f7298a9c2d168935f58c001bad88', PassHash::hmac('md5','',''));
        $this->assertEquals('fbdb1d1b18aa6c08324b7d64b71fb76370690e1d', PassHash::hmac('sha1','',''));
        $this->assertEquals('80070713463e7749b90c2dc24911e275', PassHash::hmac('md5','The quick brown fox jumps over the lazy dog','key'));
        $this->assertEquals('de7c9b85b8b78aa6bc8a7a36f70a90701c9db4d9', PassHash::hmac('sha1','The quick brown fox jumps over the lazy dog','key'));
    }

    function test_djangopbkdf2() {
        if(!function_exists('hash_pbkdf2') || !in_array('sha256', hash_algos())){
            $this->markTestSkipped('missing hash functions for djangopbkdf2 password tests');
            return;
        }

        $ph = new PassHash();
        $knownpasses = array (
            'pbkdf2_sha256$24000$LakQQ2OOTO1v$dmUgz8V7zcpaoBSA3MV76J5a4rzrszF0NpxGx6HRBbE=',
            'pbkdf2_sha256$24000$PXogIZpE4gaK$F/P/L5SRrbb6taOGEr4w6DhxjMzNAj1jEWTPyAUn8WU=',
            'pbkdf2_sha256$24000$vtn5APnhirmB$/jzJXYvm78X8/FCOMhGUmcCy0iWhtk0L1hcBWN1AYZc=',
            'pbkdf2_sha256$24000$meyCtGKrS5Ai$vkMfMzB/yGFKplmXujgtfl3OGR27AwOQmP+YeRP6lbw=',
            'pbkdf2_sha256$24000$M8ecC8zfqLmJ$l6cIa/Od+m56VMm9hJbdPNhTXZykPVbUGGTPx7/VRE4=',
        );
        foreach($knownpasses as $known) {
            $this->assertTrue($ph->verify_hash('P4zzW0rd!', $known));
        }
    }
}
