// To execute this file run Node W2RestApiGist.js

const https = require('https')

// Replace Base64EncodedW2ApiKey with your Base 64 Encoded W2ApiKey
const API_KEY = 'Basic Base64EncodedW2ApiKey'

const data = JSON.stringify({
    Bundle: 'PepDeskCheck',
    Data: { NameQuery: 'David Cameron' },
    Options: { Sandbox: 'false' },
    ClientReference: 'W2RestApiJavascriptGist'
})

const options = {
    hostname: 'api.w2globaldata.com',
    data: data,
    path: '/kyc-check',
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `${API_KEY}`,
    }
}

const req = https.request(options, res => {
    console.log(`Status Code: ${res.statusCode}`)
    console.log(`Status Message: ${res.statusMessage}`)

    res.on('data', d => {
        process.stdout.write(d) //JSON Response
    })
})

req.on('error', error => {
    console.log(error)
})

req.write(data)
req.end()
