<?php

function activeLink($name){
    return request()->is($name) ? "active-link" : "";
}