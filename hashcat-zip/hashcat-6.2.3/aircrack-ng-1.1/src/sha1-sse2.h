

/* nx5 - C code for SSE2 (i386) optimized SHA1 */


#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <time.h>

#ifndef uchar
#define uchar unsigned char
#endif

#include "crypto.h"


#if defined(__i386__) || defined(__x86_64__)

void show_result(char* key, uchar* pmk)
{
	int i;
	printf("%-14s ", key);
	for (i=0; i<32; i++)
		printf("%.2X", pmk[i]);
	printf("\n");
}


extern int shasse2_init( uchar ctx[80] )
    __attribute__((regparm(1)));

extern int shasse2_ends( uchar ctx[80], uchar digests[80] )
    __attribute__((regparm(2)));

extern int shasse2_data( uchar ctx[80], uchar data[256], uchar buf[1280] )
    __attribute__((regparm(3)));

extern int shasse2_cpuid( void );


void calc_4pmk(char* _key1, char* _key2, char* _key3, char* _key4, char* _essid, uchar* _pmk1, uchar* _pmk2, uchar* _pmk3, uchar* _pmk4)
{
	int slen;
    char  essid[36] __attribute__ ((aligned (16)));
    char  key1[128] __attribute__ ((aligned (16)));
	char  key2[128] __attribute__ ((aligned (16)));
    char  key3[128] __attribute__ ((aligned (16)));
	char  key4[128] __attribute__ ((aligned (16)));
    uchar pmks[128*4] __attribute__ ((aligned (16)));

	// All in double size
    uchar k_ipad[256] __attribute__ ((aligned (16)));
	uchar ctx_ipad[80] __attribute__ ((aligned (16)));
    uchar k_opad[256] __attribute__ ((aligned (16)));
	uchar ctx_opad[80] __attribute__ ((aligned (16)));
    uchar buffer[256] __attribute__ ((aligned (16)));
	uchar sha1_ctx[80] __attribute__ ((aligned (16)));
    uchar wrkbuf[1280] __attribute__ ((aligned (16)));
    uint i, *u, *v, *w, *u3, *v4;
	uchar *pmk1, *pmk2, *pmk3, *pmk4;

	pmk1=pmks; pmk2=pmks+128; pmk3=pmks+128*2; pmk4=pmks+128*3;


	strncpy(essid, _essid, 35);
	strncpy(key1, _key1, 127);
	strncpy(key2, _key2, 127);
	strncpy(key3, _key3, 127);
	strncpy(key4, _key4, 127);

    slen = strlen( essid ) + 4;


		/* SSE2 available, so compute four PMKs in a single row */

        memset( k_ipad, 0, sizeof( k_ipad ) );
        memset( k_opad, 0, sizeof( k_opad ) );

        memcpy( k_ipad, key1, strlen( key1 ) );
        memcpy( k_opad, key1, strlen( key1 ) );

        memcpy( k_ipad + 64, key2, strlen( key2 ) );
        memcpy( k_opad + 64, key2, strlen( key2 ) );

        memcpy( k_ipad + 128, key3, strlen( key3 ) );
        memcpy( k_opad + 128, key3, strlen( key3 ) );

		memcpy( k_ipad + 192, key4, strlen( key4 ) );
        memcpy( k_opad + 192, key4, strlen( key4 ) );


        u = (uint *) ( k_ipad      );
        v = (uint *) ( k_ipad + 64 );
		u3 = (uint *) ( k_ipad + 128 );
		v4 = (uint *) ( k_ipad + 192 );
        w = (uint *) buffer;

        for( i = 0; i < 16; i++ )
        {
            /* interleave the data */

            *w++ = *u++ ^ 0x36363636;
            *w++ = *v++ ^ 0x36363636;
            *w++ = *u3++ ^ 0x36363636;
            *w++ = *v4++ ^ 0x36363636;
        }

		shasse2_init( ctx_ipad );
        shasse2_data( ctx_ipad, buffer, wrkbuf );

        u = (uint *) ( k_opad      );
        v = (uint *) ( k_opad + 64 );
        u3 = (uint *) ( k_opad + 128 );
        v4 = (uint *) ( k_opad + 192 );
        w = (uint *) buffer;

        for( i = 0; i < 16; i++ )
        {
            *w++ = *u++ ^ 0x5C5C5C5C;
            *w++ = *v++ ^ 0x5C5C5C5C;
            *w++ = *u3++ ^ 0x5C5C5C5C;
            *w++ = *v4++ ^ 0x5C5C5C5C;
        }

        shasse2_init( ctx_opad );
        shasse2_data( ctx_opad, buffer, wrkbuf );

        memset( buffer, 0, sizeof( buffer ) );


		buffer[ 80] = buffer[ 84] = buffer[ 88] = buffer[ 92] = 0x80;
        buffer[242] = buffer[246] = buffer[250] = buffer[254] = 0x02;
        buffer[243] = buffer[247] = buffer[251] = buffer[255] = 0xA0;


		essid[slen - 1] = '\1';


		HMAC(EVP_sha1(), (uchar *)key1, strlen(key1), (uchar*)essid, slen, pmk1, NULL);
		HMAC(EVP_sha1(), (uchar *)key2, strlen(key2), (uchar*)essid, slen, pmk2, NULL);
		HMAC(EVP_sha1(), (uchar *)key3, strlen(key3), (uchar*)essid, slen, pmk3, NULL);
		HMAC(EVP_sha1(), (uchar *)key4, strlen(key4), (uchar*)essid, slen, pmk4, NULL);


		u = (uint *) pmk1;
        v = (uint *) pmk2;
		u3 = (uint *) pmk3;
        v4 = (uint *) pmk4;
        w = (uint *) buffer;

        *w++ = *u++; *w++ = *v++;
		*w++ = *u3++; *w++ = *v4++;
        *w++ = *u++; *w++ = *v++;
		*w++ = *u3++; *w++ = *v4++;
        *w++ = *u++; *w++ = *v++;
		*w++ = *u3++; *w++ = *v4++;
        *w++ = *u++; *w++ = *v++;
		*w++ = *u3++; *w++ = *v4++;
        *w++ = *u++; *w++ = *v++;
		*w++ = *u3++; *w++ = *v4++;


        for( i = 1; i < 4096; i++ )
        {
            memcpy( sha1_ctx, ctx_ipad, 80 );  //eran 40
            shasse2_data( sha1_ctx, buffer, wrkbuf );
            shasse2_ends( sha1_ctx, buffer );

            memcpy( sha1_ctx, ctx_opad, 80 );
            shasse2_data( sha1_ctx, buffer, wrkbuf );
            shasse2_ends( sha1_ctx, buffer );

            u = (uint *) pmk1;
            v = (uint *) pmk2;
            u3 = (uint *) pmk3;
            v4 = (uint *) pmk4;
            w = (uint *) buffer;

            /* de-interleave the digests */
            *u++ ^= *w++; *v++ ^= *w++;			*u3++ ^= *w++; *v4++ ^= *w++;
            *u++ ^= *w++; *v++ ^= *w++;			*u3++ ^= *w++; *v4++ ^= *w++;
            *u++ ^= *w++; *v++ ^= *w++;			*u3++ ^= *w++; *v4++ ^= *w++;
			*u++ ^= *w++; *v++ ^= *w++;			*u3++ ^= *w++; *v4++ ^= *w++;
            *u++ ^= *w++; *v++ ^= *w++;			*u3++ ^= *w++; *v4++ ^= *w++;
        }


		essid[slen - 1] = '\2';

		HMAC(EVP_sha1(), (uchar *)key1, strlen(key1), (uchar*)essid, slen, pmk1 + 20, NULL);
		HMAC(EVP_sha1(), (uchar *)key2, strlen(key2), (uchar*)essid, slen, pmk2 + 20, NULL);
		HMAC(EVP_sha1(), (uchar *)key3, strlen(key3), (uchar*)essid, slen, pmk3 + 20, NULL);
		HMAC(EVP_sha1(), (uchar *)key4, strlen(key4), (uchar*)essid, slen, pmk4 + 20, NULL);

        u = (uint *) ( pmk1 + 20 ); // eran 20
        v = (uint *) ( pmk2 + 20 );
        u3 = (uint *) ( pmk3 + 20 ); // eran 20
        v4 = (uint *) ( pmk4 + 20 );
        w = (uint *) buffer;

        *w++ = *u++; *w++ = *v++;
		*w++ = *u3++; *w++ = *v4++;
        *w++ = *u++; *w++ = *v++;
		*w++ = *u3++; *w++ = *v4++;
        *w++ = *u++; *w++ = *v++;
		*w++ = *u3++; *w++ = *v4++;
        *w++ = *u++; *w++ = *v++;
		*w++ = *u3++; *w++ = *v4++;
        *w++ = *u++; *w++ = *v++;
		*w++ = *u3++; *w++ = *v4++;

        for( i = 1; i < 4096; i++ )
        {
            memcpy( sha1_ctx, ctx_ipad, 80 ); //eran 40
            shasse2_data( sha1_ctx, buffer, wrkbuf );
            shasse2_ends( sha1_ctx, buffer );

            memcpy( sha1_ctx, ctx_opad, 80 );
            shasse2_data( sha1_ctx, buffer, wrkbuf );
            shasse2_ends( sha1_ctx, buffer );

            u = (uint *) ( pmk1 + 20 ); //eran 20
            v = (uint *) ( pmk2 + 20 );
            u3 = (uint *) ( pmk3 + 20 );
            v4 = (uint *) ( pmk4 + 20 );
            w = (uint *) buffer;

            *u++ ^= *w++; *v++ ^= *w++;			*u3++ ^= *w++; *v4++ ^= *w++;
            *u++ ^= *w++; *v++ ^= *w++;			*u3++ ^= *w++; *v4++ ^= *w++;
            *u++ ^= *w++; *v++ ^= *w++;			*u3++ ^= *w++; *v4++ ^= *w++;
        }

	memcpy(_pmk3, pmk3, 32);
	memcpy(_pmk4, pmk4, 32);
	memcpy(_pmk1, pmk1, 32);
	memcpy(_pmk2, pmk2, 32);

	/*printf("\n");
	show_result(_key1, _pmk1);
	show_result(_key2, _pmk2);
	show_result(_key3, _pmk3);
	show_result(_key4, _pmk4);
	fflush(stdout);*/

}
#else

void calc_4pmk(char* _key1, char* _key2, char* _key3, char* _key4, char* _essid, uchar* _pmk1, uchar* _pmk2, uchar* _pmk3, uchar* _pmk4)
{
	calc_pmk(_key1, _essid, _pmk1);
	calc_pmk(_key2, _essid, _pmk2);
	calc_pmk(_key3, _essid, _pmk3);
	calc_pmk(_key4, _essid, _pmk4);
}

#endif
