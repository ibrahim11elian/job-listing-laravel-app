<h2>
    {{ $job->title }}
</h2>

<div>Congrates! your job is live on your website.</div>

<p>
    <a href="{{ url("/jobs/" . $job->id) }}">View Job</a>
</p>
