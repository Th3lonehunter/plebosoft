<?php
  function get_comments() {
    /*Retrieve the comments, comment display should be sorted.

    Please also tidy up the variables. i used placeholder names just to start you off ;)
    */

    foreach($result as $item) {
      			$date = new dateTime($item['date']);
      			$date = date_format($date, 'M j, Y | H:i:s');
      			$user = $item['user'];
      			$comment = $item['text'];
      			$code = $item['code'];

      echo '<div class="comment" id="'.$code.'">'
  					.'<p class="user">'.$user.'</p>&nbsp;'
  					.'<p class="time">'.$date.'</p>'
  					.'<p class="comment-text">'.$comment.'</p>'
  					.'<a class="link-reply" id="reply" name="'.$code.'">Reply</a>';
  				$chi_result = mysqli_query($connect, "SELECT * FROM /*database table here*/`` WHERE /* Table column name */``='$code' ORDER BY `date` DESC");
  				$chi_cnt = mysqli_num_rows($chi_result);
  				if($chi_cnt == 0){
  				} else {
  					echo '<a class="link-reply" id="children" name="'.$code.'"><span id="tog_text">replies</span> ('.$chi_cnt.')</a>'
  						.'<div class="child-comments" id="C-'.$code.'">';
  					foreach($chi_result as $com) {
  						$chi_date = new dateTime($com['date']);
  						$chi_date = date_format($chi_date, 'M j, Y | H:i:s');
  						$chi_user = $com['user'];
  						$chi_com = $com['text'];
  						$chi_par = $com['code'];
  						echo '<div class="child" id="'.$code.'-C">'
  								.'<p class="user">'.$chi_user.'</p>&nbsp;'
  								.'<p class="time">'.$chi_date.'</p>'
  								.'<p class="comment-text">'.$chi_com.'</p>'
  							.'</div>';
  					}
  					echo '</div>';
  				}
  				echo '</div>';

        }
 ?>
