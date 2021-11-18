import React, { useState } from 'react';
import { Component } from 'react';
import { Route, Switch, withRouter } from 'react-router';
import HeaderAdmin from './components/HeaderAdmin';
import SidebarAdmin from './components/SidebarAdmin';
import ConsultMairie from './pages/mairie/ConsultMairie';
import InscriMairie from './pages/mairie/InscriMairie';
import Profils from './pages/Profils';

class AppAdmin extends Component {
  
  render() {

 this.HeaderAdminWithRouter = withRouter(HeaderAdmin);
    return (
      <div id="pcoded" className="pcoded">
        <div className="pcoded-container navbar-wrapper">
          <this.HeaderAdminWithRouter />
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
                        path={`${this.props.match.url}/mairies/:id`}
                        component={InscriMairie}
                      />
                       <Route
                        path={`${this.props.match.url}/mairies`}
                        component={ConsultMairie}
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
