<div class="score">

  <?php  $class='default';
  if ($percent==100){
    $class = 'green';
  }
  elseif($percent<100 && $percent>75){
    $class  = 'default';
  }else{
    $class  = 'orange';
  }
  ?>
  <h4>{{$target}}</h4>
  <div class="percentage">
    <div class="c100 p{{$percent}} big center {{$class}}">
                    <span>{{$percent}}</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
  </div>
</div>
