import React, {Component} from 'react'
import { Route, Switch, withRouter } from 'react-router';
import HeaderAuth from './components/HeaderAuth';
import Lock from './pages/Lock';
import Login from './pages/login';

class AppAuth extends Component {
  render(){
    return ( 
      <div id="pcoded" className="pcoded">
          <div className="pcoded-container navbar-wrapper">
            <HeaderAuth />
            <div className="pcoded-main-container">
              <div className="pcoded-wrapper">

                  <div className="pcoded-inner-content">
                    <div className="main-body">
               
       <Switch>
          <Route path={`${this.props.match.url}lock`}
            component={Lock} />
           <Route path={`${this.props.match.url}`}
            component={Login} />
       </Switch>
       </div>
      </div>
      </div></div></div></div>
     );
}
}
 
export default withRouter(AppAuth);