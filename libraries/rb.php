<?php
/**
 * @name		CodeIgniter RedBean
 * @author		Jens Segers
 * @link		http://www.jenssegers.be
 * @license		MIT License Copyright (c) 2011 Jens Segers
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

class RB {
    
    /**
     * Constructor, loads the original RedBean class file and performs 
     * the setup proces using CodeIgniter's database configuration: config/database.php
     */
    public function __construct() {
        // get redbean
        include (dirname(__FILE__) . '/../vendor/rb.php');
        
        // get the database config file
        if (!defined('ENVIRONMENT') or !file_exists($file_path = APPPATH . 'config/' . ENVIRONMENT . '/database.php')) {
            if (!file_exists($file_path = APPPATH . 'config/database.php')) {
                show_error('The configuration file database.php does not exist.');
            }
        }
        
        include ($file_path);
        
        // show error if config is missing
        if (!isset($db) or count($db) == 0) {
            show_error('No database connection settings were found in the database config file.');
        }
        
        // active group missing
        if (!isset($active_group) or !isset($db[$active_group])) {
            show_error('You have specified an invalid database connection group.');
        }
        
        $driver = $db[$active_group]['dbdriver'];
        $host = $db[$active_group]['hostname'];
        $user = $db[$active_group]['username'];
        $pass = $db[$active_group]['password'];
        $db = $db[$active_group]['database'];
        
        switch ($driver) {
            case 'sqlite' :
                R::setup("sqlite:$db", $user, $pass);
                break;
            default :
                R::setup("$driver:host=$host;dbname=$db", $user, $pass);
        }
    }
    
    /**
     * Magic call method that passes every call to the R object
     * @return mixed
     */
    public function __call($name, $arguments) {
        return call_user_func_array(array('R', $name), $arguments);
    }

}