<?php

// add my credits
function ojdo_credits()  
{
    print('This blog is licensed under the <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/">Creative Commons Attribution-ShareAlike 3.0</a> license. Reviewed music is licensed under various Creative Commons licenses by their generous creators.');
}
add_action( 'twentysixteen_credits', 'ojdo_credits' );

?>