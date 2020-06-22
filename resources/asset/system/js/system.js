getCSRFToken = () => {
    return $('meta[name="csrf"]').attr('content')
  }
  
  generateRandomString = length => {
    let result = ''
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'
    const charactersLength = characters.length
    for (let i = 0; i < length; i++) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength))
    }
    return result
  }
  
  require('./backend')
  require('./translation')
  require('./admin')
  require('./config')
  require('./timeFormat')
  