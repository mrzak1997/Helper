import { DashboardModule } from './Components/dashboard/dashboard.module';
import { RegisterModule } from './Components/user/register/register.module';
import { AlertComponent } from './Components/shared/alert/alert.component';
import { LoginModule } from './Components/user/login/login.module';
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { TitleBarComponent } from './Components/shared/title-bar/title-bar.component';

import { IpcService } from './services/ipc/ipc.service';
import { MatSliderModule } from '@angular/material/slider';
import {MatIconModule} from '@angular/material/icon';
import { HttpClientModule } from '@angular/common/http';
import { httpInterceptorProviders } from './helpers';
import {MatGridListModule} from '@angular/material/grid-list';



@NgModule({
  declarations: [
    AppComponent,
    TitleBarComponent,
    AlertComponent,


  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MatSliderModule,
    LoginModule,
    MatIconModule,
    HttpClientModule,
    RegisterModule,
    DashboardModule,
    MatGridListModule
  ],
  exports:[

  ],
  providers: [httpInterceptorProviders,IpcService],
  bootstrap: [AppComponent]
})
export class AppModule { }
