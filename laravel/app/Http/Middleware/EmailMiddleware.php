<?php

namespace App\Http\Middleware;

use Nette\Mail\Message;
use Nette\Mail\SmtpMailer;
use Closure;

class EmailMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $rs = $next($request);

        if ($request->user()) {
            $mail = new Message;
            $mail->setFrom('Shawn <xuchaobing02@163.com>')
                ->addTo($request->user()->email)
                ->setSubject('恭喜您，注册成功')
                ->setBody("您好,".$request->user()->name.",恭喜您注册成功,您已成为dddai的会员");

            $mailer = new SmtpMailer([
                'host' => 'smtp.163.com',
                'username' => 'xuchaobing02@163.com',
                'password' => 'xcbXCB'
            ]);
            $mailer->send($mail);
        }
        return $rs;
    }
}
