

<h2>お問い合わせ内容</h2>

<p>
    <strong>名前：</strong>
    {{ $contact['name'] }}
</p>

<p>
    <strong>メールアドレス：</strong>
    {{ $contact['email'] }}
</p>

<p>
    <strong>お問い合わせ内容：</strong>
</p>

<p>
    {!! nl2br(e($contact['message'])) !!}
</p>
