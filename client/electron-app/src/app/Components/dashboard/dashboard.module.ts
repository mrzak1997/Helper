
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DashboardComponent } from './dashboard.component';
import {MatGridListModule} from '@angular/material/grid-list';
import { MatIconModule } from '@angular/material/icon';
import { CreateFlowchartComponent } from './create-flowchart/create-flowchart.component';
import { AppRoutingModule } from '../../app-routing.module';
import { RouterModule } from '@angular/router';
import {MatTooltipModule} from '@angular/material/tooltip';
@NgModule({
  declarations: [
    DashboardComponent,
    CreateFlowchartComponent
  ],
  imports: [
    CommonModule,
    MatGridListModule,
    MatIconModule,
    AppRoutingModule,
    RouterModule,
    MatTooltipModule
    
  ]
})
export class DashboardModule { }
