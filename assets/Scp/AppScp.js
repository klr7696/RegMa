import React from 'react';
import { Component } from 'react';
import { Route, Switch, withRouter } from 'react-router';
import HeaderScp from './components/HeaderScp';
import SidebarScp from './components/SidebarScp';
import Lot from './pages/Lot';
import Offre from './pages/Offre';
import PlanPassation from './pages/PlanPassation';
import Projet from './pages/Projet';

class AppScp extends Component {
  render() {
    return (
      <div id="pcoded" className="pcoded">
        <div className="pcoded-container navbar-wrapper">
          <HeaderScp />
          <div className="pcoded-main-container">
            <div className="pcoded-wrapper">
              <SidebarScp />
              <div className="pcoded-content">
                <div className="pcoded-inner-content">
                  <div className="main-body">
                    <Switch>
                      <Route
                        path={`${this.props.match.url}/plan`}
                        component={PlanPassation}
                      />
                       <Route
                        path={`${this.props.match.url}/projet`}
                        component={Projet}
                      />
                      <Route
                        path={`${this.props.match.url}/offre`}
                        component={Offre}
                      />
                      <Route
                        path={`${this.props.match.url}/lot`}
                        component={Lot}
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

export default withRouter(AppScp);
