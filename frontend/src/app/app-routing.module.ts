import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { RegisterComponent } from './register/register.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { HistoricalComponent } from './historical/historical.component';

const routes: Routes = [
  {path: '', component: HomeComponent},
  {path: 'cadastrar', component: RegisterComponent},
  {path: 'painel', component: DashboardComponent},
  {path: 'historico', component: HistoricalComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
