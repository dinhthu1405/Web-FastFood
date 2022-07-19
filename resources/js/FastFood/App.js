import React from 'react'
import { BrowserRouter, Routes, Route } from "react-router-dom"

const HomePage = () => (
    <div>
        <h1>Đây là home page component</h1>
    </div>
)
const ProfilePage = () => (
    <div>
        <h1>Đây là profile component</h1>
    </div>
)
const AboutPage = () => (
    <div>
        <h1>Đây là page về chúng tôi nè</h1>
    </div>
)

function App(props) {

    return (
        <div className="AppComponent post" id="Application">
            <BrowserRouter basename={CONFIG.WEB.USER_POST}>
        
                <Switch>
                    <Route exact path="/" component={HomePage} />
                    <Route path="/profile" component={ProfilePage} />
                    <Route path="/about" component={AboutPage} />
                </Switch>
            </BrowserRouter>
        </div>
    )
}

export default App