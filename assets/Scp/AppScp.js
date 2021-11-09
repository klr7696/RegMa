import React from 'react';
import { Component } from 'react';
import { Route, Switch, withRouter } from 'react-router';
import HeaderScp from './components/HeaderScp';
import SidebarScp from './components/SidebarScp';
import Lot from './pages/Lot';
import ConsultLot from './pages/LotMarche/ConsultLot';
import InscriLot from './pages/LotMarche/InscriLot';
import Offre from './pages/Offre';
import PlanPassation from './pages/PlanPassation';
import ConsultPlan from './pages/PlanPassation/ConsultPlan';
import InscriPlan from './pages/PlanPassation/InscriPlan';
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
                        path={`${this.props.match.url}/plan/:id`}
                        component={InscriPlan}
                      />
                       <Route
                        path={`${this.props.match.url}/plan`}
                        component={ConsultPlan}
                      />
                      <Route
                        path={`${this.props.match.url}/lot-marche/:id`}
                        component={InscriLot}
                      />
                      <Route
                        path={`${this.props.match.url}/lot-marche`}
                        component={ConsultLot}
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
