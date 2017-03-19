<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'cnp' => [
		'0'=>Yii::t('app','-- Choose card availability'),
		'1'=>Yii::t('app','card present'),
		'2'=>Yii::t('app','card not present (CNP)'),
	],
];
