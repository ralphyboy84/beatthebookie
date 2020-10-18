$(document).ready(function () {
  $('#showAllFixtures').change(function () {
    if ($(this).val() == 'yes') {
      $('div .well').removeClass('hideRow');
    } else {
      $('div .noPredictorRow').addClass('hideRow');
    }
  });

  $('#showLeague').change(function () {
    if (!$(this).val()) {
      $('div .well').removeClass('hideRow');
    } else {
      $('div .well').addClass('hideRow');
      $('div .' + $(this).val()).removeClass('hideRow');
    }
  });

  $('#showMode').change(function () {
    if (!$(this).val()) {
      document.location.href = 'index.php';
    } else {
      document.location.href = 'index.php?mode=gr';
    }
  });

  $('.previewCell').click(function () {
    fixtureid = $(this).attr('data-fixtureid');

    $('#dialog').dialog({
      width: '90%',
      modal: true,
    });

    $.ajax({
      url: 'popUp.php',
      type: 'POST',
      dataType: 'html',
      data: {
        fixtureid: fixtureid,
      },
      success: function (data) {
        $('#dialog').html(data);
      },
    });
  });
});
