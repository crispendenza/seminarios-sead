<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
    <head>
        <script>
            function toPNG(image) {
                image.onerror = null;
                image.src = image.src.replace(/\.svg$/, ".png");
            }
        </script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">        
        <meta http-equiv="Content-Language" content="pt-br">
        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    </head>

    <body>

        <div class="container" id="page">

            <div id="header">
                <div id="logo">
                    <?php /* cho CHtml::encode(Yii::app()->name); */ ?>
                    <img href="#" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.svg" alt="Seminários SEaD" onerror="toPNG(this);">                     
                </div>
            </div><!-- header -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'activeCssClass' => 'active',
                    'activateParents' => true,
                    'items' => array(
                        array('label' => 'Início', 'url' => array('/site/index'), 'htmlOptions' => 'style: padding-left: 10px'),
                        array('label' => Yii::app()->user->isInRole('ADMIN') ? 'Inscrições' : 'Minhas Inscrições', 'url' => array('/inscricao/index'), 'visible' => !Yii::app()->user->isGuest,
                            'items' => array(
                                array('label' => 'Nova', 'url' => array('/inscricao/create'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
                                array('label' => 'Gerenciar', 'url' => array('/inscricao/admin'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
                                array('label' => 'Listar', 'url' => array('/inscricao/index'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
                                array('label' => 'Confirmar Presença', 'url' => array('/inscricao/presenca'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
                                array('label' => 'Gerar Certificado', 'url' => array('/inscricao/certificado')),
                            ),
                        ),
                        array('label' => 'Usuários', 'url' => array('/usuario/admin'), 'visible' => Yii::app()->user->isInRole('ADMIN'),
                            'items' => array(
                                array('label' => 'Novo', 'url' => array('/usuario/create'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
                                array('label' => 'Gerenciar', 'url' => array('/usuario/admin'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
                                array('label' => 'Listar', 'url' => array('/usuario/index'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
                            ),
                        ),
                        array('label' => 'Palestrantes', 'url' => array('/palestrante/admin'), 'visible' => Yii::app()->user->isInRole('ADMIN'),
                            'items' => array(
                                array('label' => 'Novo', 'url' => array('/palestrante/create'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
                                array('label' => 'Gerenciar', 'url' => array('/palestrante/admin'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
                                array('label' => 'Listar', 'url' => array('/palestrante/index'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
                            ),
                        ),
                        array('label' => 'Mesas Redondas', 'url' => array('/mesaRedonda/admin'), 'visible' => Yii::app()->user->isInRole('ADMIN'),
                            'items' => array(
                                array('label' => 'Nova', 'url' => array('/mesaRedonda/create'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
                                array('label' => 'Gerenciar', 'url' => array('/mesaRedonda/admin'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
                                array('label' => 'Listar', 'url' => array('/mesaRedonda/index'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
                            ),
                        ),
                        array('label' => 'Seminários', 'url' => array('/seminario/admin'), 'visible' => Yii::app()->user->isInRole('ADMIN'),
                            'items' => array(
                                array('label' => 'Nova', 'url' => array('/seminario/create'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
                                array('label' => 'Gerenciar', 'url' => array('/seminario/admin'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
                                array('label' => 'Listar', 'url' => array('/seminario/index'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
                            ),
                        ),
                        array('label' => 'Entrar', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Sair (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                    ),
                ));
                ?>
            </div><!-- mainmenu -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

            <div class="clear"></div>

            <div id="footer">
                <a href="http://www.sead.ufscar.br" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo-sead.svg" alt="SEaD" height="74" width="185" style="padding: 15px 0px"></a><br>
                <p>© <?php echo date('Y'); ?> Secretaria Geral de Educação a Distância</p><br/>

            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
