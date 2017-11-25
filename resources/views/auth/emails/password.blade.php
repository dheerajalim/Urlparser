Dear {{$user->name}},

<br>

<?php $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()); ?>
<p>
We have received a request from your side to reset your password.<br>

To reset your password: <a href="{{ $link }} ">Click here</a></br>
<b>Note: The link will expire in 60 minutes.</b><br>

If you have not requested for password change, kindly ignore.<br>

Thanks,<br>
URLParser

</p>

