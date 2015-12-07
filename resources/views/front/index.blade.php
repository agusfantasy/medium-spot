@extends('front.master')

@section('container')
<div class="blog-post">
  <?php foreach($articles->data as $k => $row): ?>
      <h2 class="blog-post-title"><?php echo $row->title ?></h2>
      <p class="blog-post-meta">December 23, 2013 by <a href="#"> <?php session('user')->name ?></a></p>
      <p><?php echo nl2br($row->content) ?></p>
  <?php endforeach; ?>
</div><!-- /.blog-post -->

<nav>
  <ul class="pager">
    <li><a href="#">Previous</a></li>
    <li><a href="#">Next</a></li>
  </ul>
</nav>
@stop