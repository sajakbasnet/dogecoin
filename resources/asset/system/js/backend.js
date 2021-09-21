$(document).ready(function () {
  sidebar.init()
  confirmDelete.init()
  fileInput.init()
})

const sidebar = (function () {
  const init = () => {
    highlightModule()
  }

  const highlightModule = () => {
    const prefix = $('input[name="prefix"]').val();
    const $navSidebar = $('.nav-sidebar')

    var path = window.location.pathname.split('/'+prefix+"/");
    if(path[1].includes("/")){
      path = path[1].split("/")[0];
    }else{
      path = path[1];
    }
    if (path !== undefined && window.location.pathname.includes(path)) {
      $navSidebar.find("a[href$='" + path + "']").closest('li').addClass('active');
      $navSidebar.find("a[href$='" + path + "']").parents().eq(2).addClass('active');
      $navSidebar.find("a[href$='" + path + "']").closest('.collapse').collapse();
    }
  }

  return {
    init,
  }
})()

const confirmDelete = (function () {
  const $modal = $('#confirmDeleteModal')
  const $deleteBtn = $('.btn-delete')
  const $deleteForm = $modal.find('form')

  const init = () => {
    attachEventListeners()
  }

  const attachEventListeners = () => {
    $deleteBtn.on('click', handleDeleteBtnClick)
    $modal.on('hidden.bs.modal', handleModalHidden)
  }

  const handleDeleteBtnClick = function () {
    const url = $(this).data('href')
    setDeleteUrl(`${url}?_method=DELETE`)
  }

  const handleModalHidden = function () {
    setDeleteUrl('')
  }

  const setDeleteUrl = url => {
    $deleteForm.attr('action', url)
  }

  return {
    init,
  }
})()

const fileInput = (function () {
  const init = function () {
    $(document).on('change', '.custom-file-input', function () {
      let files = []
      for (let i = 0; i < $(this)[0].files.length; i++) {
        files.push($(this)[0].files[i].name)
      }
      $(this).next('.custom-file-label').html(files.join(', '))
    })
  }

  return {
    init,
  }
})()
