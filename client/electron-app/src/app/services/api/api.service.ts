import { Injectable } from '@angular/core';
import { HttpClient,HttpInterceptor, HttpHeaders, HttpRequest } from '@angular/common/http';

import { Observable, of } from 'rxjs';
import { catchError, map, tap, } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  url = 'http://localhost/TraderHelper/BackEnd/Services/'
  httpOptionsFullResponse: { headers : any; observe : any; } = {
    headers: new HttpHeaders({ 
      'Content-Type': 'application/json',
      'Accept': 'application/json'
      
     }),
     observe: 'response'
  };
  constructor(private http: HttpClient) {
    
   }

   get(path: string): Observable<any> {
    console.warn('api = ' +`${this.url}${path}`)
   return this.http.get(`${this.url}${path}`,{observe: 'response'})
   .pipe(
     catchError(this.handleError<any>('get', []))
     
   )
 
  }

  postWithError(path: string,body: object = {}): Observable<any> {
    return this.http.post<any>(`${this.url}${path}`, 
                                JSON.stringify(body), 
                                this.httpOptionsFullResponse)
  }



  private handleError<T>(operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {
  
      // TODO: send the error to remote logging infrastructure
      console.error(error); // log to console instead
  
      // TODO: better job of transforming error for user consumption
      //this.log(`${operation} failed: ${error.message}`);
  
      // Let the app keep running by returning an empty result.
      return of(result as T);
    };
  }
}

