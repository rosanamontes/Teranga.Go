<?php
/**
 * Walled garden CSS
 */
?>

h1.elgg-heading-walledgarden {
    display: none;
}

.elgg-page-default {
    width: 100%;
    max-width: 1238px;
    margin: 0px auto; 
    border-right: 2px solid #eee;
    background: #ffffff;
    border-left: 2px solid #eee;
    min-width: 100px;
        -moz-box-shadow: 0 0 0 #eee;
        -webkit-box-shadow: 0 0 0 #eee;
        box-shadow: 0 0 0 #eee;
}

.elgg-body-walledgarden {
    margin: 100px auto 0px;
    position: relative;
    max-width: 530px;
    width: 100%;
}

.elgg-walledgarden-double > .elgg-head {
    background: #eee;
    
}
.elgg-walledgarden-double > .elgg-body {
    background: #eee;
    padding-bottom: 20px;    
}

.elgg-walledgarden-double > .elgg-foot {
    background: #eee;
}

.elgg-walledgarden-single > .elgg-head {
    background: #eee;
}
.elgg-walledgarden-single > .elgg-body {
    background: #eee;
}
.elgg-walledgarden-single > .elgg-foot {
    background: #eee;
}

.elgg-module-walledgarden-login .elgg-form-login {
    padding-top: 20px;
    padding-left: 0px;
    width: 230px;
    margin: 0px auto;
}

.elgg-module-et-login {
    background: none repeat scroll 0% 0% #EEE;
    min-height: 315px;
    margin-bottom: 50px;
    border-bottom: 1px dashed #eee;
    background: #fff; 
    margin-top: -80px;
}

.custom-index .elgg-form{
    max-width: 200px;
}

@media only screen and (min-width: 768px) {

h1.elgg-heading-walledgarden {
    display: inline;
}

.elgg-body-walledgarden {
    margin: 100px auto 0px;
    position: relative;
    width: 530px;
}
.custom-index .elgg-form{
    max-width: 300px;
}
}