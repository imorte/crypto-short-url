
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));
//
// const app = new Vue({
//     el: '#app'
// });

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function() {
    const $form = $('[data-form]');
    const $dataContent = $('[data-content]');
    const $input = $('[data-copy]');

    $($form).on('submit', function(e) {
       e.preventDefault();
       $.ajax({
           method: 'POST',
           data: $(this).serialize(),
           url: '/generate'
       }).done(function(result) {
           $dataContent.attr('data-content', 'Ссылка преобразована');
           $input.val(document.location.hostname + '/' + result);
       }).fail(function(error) {
           let errorText = JSON.parse(error.responseText).url;
           $dataContent.attr('data-content', errorText);
       });
    });
});