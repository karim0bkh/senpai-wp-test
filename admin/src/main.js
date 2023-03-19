//import jQuery from "jquery";
//window.jQuery = jQuery;

import Swal from 'sweetalert2';
window.Swal = Swal;

import 'public-ip';

import 'js-loading-overlay'

import'./style.css';

jQuery(document).ready(function($){
    console.log('main ready');
    publicIp.v4().then(function(ipv4){
        $('#senpai-info-ip-v4').html(ipv4);
    }).catch(e => {
        console.log('There has been a problem with your fetch operation IP V4: ' + e.message);
        $('#senpai-info-ip-v4').html('Not Reachable');
      });
})