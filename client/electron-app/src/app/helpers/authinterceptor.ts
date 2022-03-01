import { Injectable } from '@angular/core';
import {
  HttpEvent, HttpInterceptor, HttpHandler, HttpRequest
} from '@angular/common/http';

import { Observable } from 'rxjs';
import { 
   
    Inject, 
    PLATFORM_ID 
    } from '@angular/core';
  import { 
    isPlatformBrowser 
    } from '@angular/common';

/** Pass untouched request through to the next request handler. */
@Injectable()
export class AuthInterceptor implements HttpInterceptor {
    constructor( @Inject(PLATFORM_ID)
    private platformId: any){
        
    }
    
    intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
        // add authorization header with basic auth credentials if available
        //const currentUser ='Basic ' + btoa('09128026607:123456')
        //'Bearer '
        let token = '';
        try{
            if (isPlatformBrowser(this.platformId)) {
            token = 'Bearer '+ localStorage.getItem('token')
            }
        }
        finally{
            
        }
        if (isPlatformBrowser(this.platformId)) {
        
            if (localStorage.getItem('token')) {
                let user = ''
                user = localStorage.getItem('user') || ''
                let Token = ''
                Token = localStorage.getItem('token') || ''
                request = request.clone({
                    setHeaders: { 
                        username: user,
                        Token: Token
                    
                    }
                });
            }
        }
        return next.handle(request);
    }
}