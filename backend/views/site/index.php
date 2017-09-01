<?php

/* @var $this yii\web\View */

$this->title = '汇师网后台管理系统';
\backend\assets\SiteAsset::register($this);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 illu" style="width:23%">
            <dl>
                <dt>我的个人信息</dt>
                <dd>
                    <ul>
                        <li>你好，<?=$model->username?></li>
                        <li>上次登录时间：<?=$model->last_login?></li>
                        <li>上次登录IP：<?=$model->last_ip?> </li>
                    </ul>
                </dd>
            </dl>

        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 illu"  style="width:23%">
            <dl>
                <dt>信息统计</dt>
                <dd>
                    <ul>
                        <li>通知公告总数：9篇</li>
                        <li>上传文件总数：20个</li>
                        <li>在线调研问卷：15篇</li>

                    </ul>
                </dd>
            </dl>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 illu"  style="width:23%">
            <dl>
                <dt>系统信息</dt>
                <dd>
                    <ul>
                        <li>程序版本：V1.0 [20170527]</li>
                        <li>操作系统：CentOS Linux release 7.3.1611</li>
                        <li>web服务器软件：Nginx1.12.0</li>
                        <li>MySQL 版本：5.6.36</li>
                        <li>PHP 版本：5.6.30</li>
                        <li>上传文件：2M</li>
                    </ul>
                </dd>
            </dl>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 illu"  style="width:23%">
            <dl>
                <dt>网站信息</dt>
                <dd>
                    <ul>
                        <li>版权所有：成都大术光年信息技术有限公司</li>
                        <li>官方网站：http://www.grandmagic.cn</li>
                        <!--                        <li>官方论坛：http://bbs.xxx.com</li>-->
                    </ul>
                </dd>
            </dl>
        </div>
    </div>
    <!-- 第一行结束 -->

</div>
