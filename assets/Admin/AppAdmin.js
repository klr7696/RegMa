import React from 'react';
import { Component } from 'react';
import { Route, Switch, withRouter } from 'react-router';
import HeaderAdmin from './components/HeaderAdmin';
import SidebarAdmin from './components/SidebarAdmin';
import Mairie from './pages/Mairie';
import Profils from './pages/Profils';

class AppAdmin extends Component {
  render() {
    return (
      <div id="pcoded" className="pcoded">
        <div className="pcoded-container navbar-wrapper">
          <HeaderAdmin />
          <div className="pcoded-main-container">
            <div className="pcoded-wrapper">
              <SidebarAdmin />
              <div className="pcoded-content">
                <div className="pcoded-inner-content">
                  <div className="main-body">
                    <Switch>
                      <Route
                        path={`${this.props.match.url}/profils`}
                        component={Profils}
                      />
                       <Route
                        path={`${this.props.match.url}/mairie`}
                        component={Mairie}
                      />
                    </Switch>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  );
}
}

export default withRouter(AppAdmin);
