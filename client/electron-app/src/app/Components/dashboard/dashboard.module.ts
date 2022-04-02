
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DashboardComponent } from './dashboard.component';
import {MatGridListModule} from '@angular/material/grid-list';
import { MatIconModule } from '@angular/material/icon';
import { CreateFlowchartComponent } from './create-flowchart/create-flowchart.component';
import { AppRoutingModule } from '../../app-routing.module';
import { RouterModule } from '@angular/router';
import {MatTooltipModule} from '@angular/material/tooltip';
import { ReactiveFormsModule } from '@angular/forms';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import {MatSelectModule} from '@angular/material/select';
import {MatInputModule} from '@angular/material/input';
import {MatButtonModule} from '@angular/material/button';
import { NodePipe } from 'src/app/helpers/node-pipe.pipe';
@NgModule({
  declarations: [
    DashboardComponent,
    CreateFlowchartComponent,
    NodePipe,
  ],
  imports: [
    CommonModule,
    MatGridListModule,
    MatIconModule,
    AppRoutingModule,
    RouterModule,
    MatTooltipModule,
    ReactiveFormsModule,
    MatInputModule,
    BrowserAnimationsModule,
    MatButtonModule,
    MatSelectModule

  ]
})
export class DashboardModule { }
