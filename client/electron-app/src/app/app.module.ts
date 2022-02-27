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


@NgModule({
  declarations: [
    AppComponent,
    TitleBarComponent,
    
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MatSliderModule,
    LoginModule,
    MatIconModule,
    HttpClientModule 
    
  ],
  exports:[
   
  ],
  providers: [IpcService],
  bootstrap: [AppComponent]
})
export class AppModule { }
