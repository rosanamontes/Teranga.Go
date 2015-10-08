<?php
/**
 * Custom Index CSS
 *
 */
$et2mod = elgg_get_plugin_setting('et2menu','easytheme2');
?>

/*******************************
	Custom Index
********************************/

.custom-index {
    padding: 20px;
    padding-top: 10px;
    }
.elgg-module-featured {
    float: left;
    width: 100%;
    min-height: 200px;	
    border: 1px solid <?php echo $et2mod; ?>;	
    margin-right: 10px;
    border-radius: 0;
    }
.elgg-module-featured  .elgg-head {
    padding: 10px;
    background-color: <?php echo $et2mod; ?>;
    }
.elgg-module-featured > .elgg-body{
    padding: 0px;
    padding-bottom: 10px;
    }
.elgg-module-featured > .elgg-body h3{
    color: #fff;
    }
.elgg-module-featured > .elgg-body h2 {
    padding: 10px;
    padding-bottom: 0px;
    }
.elgg-module-featured > .elgg-body .elgg-list {
    border-top: 0;
    }
.custom-index .elgg-form-login {	
    max-width: 200px;
    }
.custom-index .elgg-form-register {	
    max-width: 300px;
    }
.custom-index .elgg-content {
    max-width: 240px;
    }
.elgg-module-et-login{
    background: #eee;
    min-height: 450px;
    margin-bottom: 50px;}
.elgg-module-et-login h3{
    padding: 10px 0 10px 10px;
    background: #708090;
    color: #eee;
    }
.elgg-module-et-login .elgg-head{
    border-bottom:0;
    }
.et-module-intro {	
    text-align: center;
    font-size: 2em;
    line-height: 1.6em;
    color: #708090;
    font-style: normal;
    font-family: Georgia,times,serif;
    padding: 45px 0 30px 0;
    margin-bottom: 50px;
    border-bottom: 1px dashed #eee;
}
.et-module-text-left{
    text-align: justify;	
    min-height: 200px;
    background: #fff;
    margin-bottom: 20px;
    padding: 0 20px 0 20px;
}
.et-module-text-left h2, .et-module-text-right h2{
    text-align: center;
}
.et-module-text-left > p > img {
    border-width: 0px;
    border-color: transparent;
    margin: 0px auto;
    display: block;
    max-width: 400px;
    width: 100%;
    height: auto;
}
.et-module-text-right{
    text-align: justify;	
    min-height: 200px;
    background: #fff;
    margin-bottom: 20px;
    padding: 0 20px 0 20px;
}
.et-module-message {	
    border: 1px solid <?php echo $et2mod; ?>;
    padding: 15px;
    margin-bottom: 20px;
    min-height: 260px;
    height: auto !important; 
    height: 260px;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 6px;
}
.et-module-message h3{
    margin-bottom: 15px;
}
.et-module-message h2{
    margin-bottom: 12px;
}
.custom-index .elgg-gallery{
    margin-top: 10px;
    margin-left: 8px;
}
.custom-index .elgg-form {
    padding-top: 30px;
    padding-left: 0px;
    width: 300px;
    margin: 0 auto;
}
.custom-index .elgg-list {
    padding: 10px;
}
.custom-index .prl {
    padding: 0px;
}
.et-latest{
    display: inline-block; 
    border-top: 1px dashed #eee; 
    padding: 50px 0 20px 0; 
    padding-left: 0px; 
}
.et-register{
    display: none;
}	
@media only screen and (min-width: 481px) {
.custom-index .prl {
    padding-right: 20px;
}
.custom-index .pvm {
    padding-top: 0px;
}
}
@media only screen and (min-width: 480px) {
.custom-index .elgg-form-login {
    width: 100%;
    max-width: 300px;
}
}
@media only screen and (min-width: 768px) {
.elgg-module-featured {
    float: left;
    width: 31%;
    min-height: 200px;	
    border: 1px solid <?php echo $et2mod; ?>;	
    margin-right: 10px;
    border-radius: 0;
}
.et-module-text-right{
    text-align: justify;	
    min-height: 200px;
    background: #fff;
    margin-bottom: 20px;
    padding: 0 30px 0 25px;
}
.et-module-text-left{
    text-align: justify;	
    min-height: 200px;
    background: #fff;
    margin-bottom: 20px;
    padding: 0 25px 0 10px;
}
.et-module-intro {	
    text-align: center;
    font-size: 2em;
    line-height: 1.6em;
    color: #708090;
    font-style: normal;
    font-family: Georgia,times,serif;
    padding: 15px 0 30px 0;
    margin-bottom: 50px;
    border-bottom: 1px dashed #eee;
}
.et-register{
    display: inline-block;	
    background: #eee;
    min-height: 450px;
    margin-bottom: 50px;
    width: 100%;
}
.et-register h3{
    padding: 10px 0 10px 10px;
    background: #708090;
    color: #eee;
}
.et-latest{
    display: inline-block; 
    border-top: 1px dashed #eee; 
    padding: 50px 0 20px 0; 
    padding-left: 40px; 
}
}

