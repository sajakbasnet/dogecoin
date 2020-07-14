$(document).ready(function () {
  languageSelector.init()
  translation.init()
})

const languageSelector = (function () {
  const $countrySelector = $('#country_id')
  const $languageSelecor = $('#language_code')
  const $prefix = $countrySelector.data('prefix')

  const init = () => {
    registerEventListeners()
  }

  const registerEventListeners = () => {
    $countrySelector.on('change', handleCountryChange)
  }

  const handleCountryChange = function () {
    const countyId = $(this).val()
    populateLanguages(countyId)
  }

  const populateLanguages = countryId => {
    let $languageOptions = `<option value="">Select Language</option>`
    $.ajax({
      url: '/' + $prefix + '/country-language/' + countryId,
      type: "GET",
      success: (response) => {
        const languages = response.languages;
        languages.forEach(({ name, iso639_1: code }) => {
          $languageOptions += `<option value="${code}">${name} (${code})</option>`
        })
        $languageSelecor.html($languageOptions)
      },
      error: () => {
        $.toast({
          heading: 'ERROR',
          text: 'Something went wrong.',
          showHideTransition: 'plain',
          icon: 'error',
          position: 'bottom-center',
        })
      },
    })
  }

  return {
    init,
  }
})()

const translation = (function () {
  const $content = $('.translation-content')
  const csrfToken = getCSRFToken()

  const init = () => {
    registerEventListeners()
  }

  const registerEventListeners = () => {
    $content.on('change', handleContentChange)
  }

  const handleContentChange = function () {
    updateText($(this).val(), $(this).data('href'))
  }

  const updateText = (value, url) => {
    $.ajax({
      url,
      type: 'POST',
      data: {
        text: value,
        _csrf: csrfToken,
      },
      success: () => {
        $.toast({
          heading: 'Success',
          text: 'Successfully updated.',
          showHideTransition: 'plain',
          icon: 'success',
          position: 'bottom-center',
        })
      },
      error: () => {
        $.toast({
          heading: 'ERROR',
          text: 'Something went wrong.',
          showHideTransition: 'plain',
          icon: 'error',
          position: 'bottom-center',
        })
      },
    })
  }

  return { init }
})()
