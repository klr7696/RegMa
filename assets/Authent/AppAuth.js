import React, {Component} from 'react'
import { Route, Switch, withRouter } from 'react-router';
import Lock from './pages/Lock';
import Login from './pages/login';

class AppAuth extends Component {
  render(){
    return ( 
                    <div className="main-body">
               
       <Switch>
          <Route path={`${this.props.match.url}lock`}
            component={Lock} />
           <Route path={`${this.props.match.url}`}
            component={Login} />
       </Switch>
       </div>
      
     );
}
}
 
export default withRouter(AppAuth);