<?php

// always use htmlspecialchars before you drop dynamic data onto your page!
function h($string="") {
	return htmlspecialchars($string);
}