import React from 'react'
import ReactDOM from 'react-dom'
import App from "./App"

if (typeof (Storage) !== 'undefined' && document.getElementById('react__root')) {

    ReactDOM.render(
        <App />
        , document.getElementById('application'))
} else {
    alert("Trình duyệt của bạn đã cũ và không được hộ trợ. Mong bạn nâng cấp")
}

// // In your case, you want to put your call to localStorage in such an if clause, for example:
// if (typeof window !== 'undefined') {
//     localStorage.setItem('myCat', 'Tom');
// }

// if (typeof window !== 'undefined') {
//     // console.log('we are running on the client')
//     alert("client")
// } else {
//     // console.log('we are running on the server')
//     alert("server")
// }