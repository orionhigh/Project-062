# 
# /*
#  * *********** WARNING **************
#  * This file generated by ModPerl::WrapXS/0.01
#  * Any changes made here will be lost
#  * ***********************************
#  * 01: lib/ModPerl/Code.pm:709
#  * 02: \xampp\perl\bin\.cpanplus\5.10.1\build\mod_perl-2.0.4\blib\lib/ModPerl/WrapXS.pm:626
#  * 03: \xampp\perl\bin\.cpanplus\5.10.1\build\mod_perl-2.0.4\blib\lib/ModPerl/WrapXS.pm:1175
#  * 04: \xampp\perl\bin\.cpanplus\5.10.1\build\mod_perl-2.0.4\Makefile.PL:423
#  * 05: \xampp\perl\bin\.cpanplus\5.10.1\build\mod_perl-2.0.4\Makefile.PL:325
#  * 06: \xampp\perl\bin\.cpanplus\5.10.1\build\mod_perl-2.0.4\Makefile.PL:56
#  * 07: \xampp\perl\bin\cpanp-run-perl.bat:21
#  */
# 


package APR::URI;

use strict;
use warnings FATAL => 'all';


use APR ();
use APR::XSLoader ();
our $VERSION = '0.009000';
APR::XSLoader::load __PACKAGE__;



1;
__END__

=head1 NAME

APR::URI - Perl API for URI manipulations




=head1 Synopsis

  use APR::URI ();
  
  my $url = 'http://user:pass@example.com:80/foo?bar#item5';
  
  # parse and break the url into components
  my $parsed = APR::URI->parse($r->pool, $url);
  print $parsed->scheme;
  print $parsed->user;
  print $parsed->password;
  print $parsed->hostname;
  print $parsed->port;
  print $parsed->path;
  print $parsed->rpath;
  print $parsed->query;
  print $parsed->fragment;
  
  # reconstruct the url, after changing some components and completely
  # removing other
  $parsed->scheme($new_scheme);
  $parsed->user(undef);
  $parsed->password(undef);
  $parsed->hostname($new_hostname);
  $parsed->port($new_port);
  $parsed->path($new_path);
  $parsed->query(undef);
  $parsed->fragment(undef);
  print $parsed->unparse;
  
  # get the password field too (by default it's not revealed)
  use APR::Const -compile => qw(URI_UNP_REVEALPASSWORD);
  print $parsed->unparse(APR::Const::URI_UNP_REVEALPASSWORD);
  
  # what the default port for the ftp protocol?
  my $ftp_port = APR::URI::port_of_scheme("ftp");




=head1 Description

C<APR::URI> allows you to parse URI strings, manipulate each of the
URI elements and deparse them back into URIs.

All C<APR::URI> object accessors accept a string or an C<undef> value
as an argument. Same goes for return value. It's important to
distinguish between an empty string and C<undef>. For example let's
say your code was:

  my $uri = 'http://example.com/foo?bar#item5';
  my $parsed = APR::URI->parse($r->pool, $uri);

Now you no longer want to the query and fragment components in the
final url. If you do:

  $parsed->fragment('');
  $parsed->query('');

followed by:

  my $new_uri = parsed->unparse;

the resulting URI will be:

  http://example.com/foo?#

which is probably not something that you've expected. In order to get
rid of the separators, you must completely unset the fields you don't
want to see. So, if you do:

  $parsed->fragment(undef);
  $parsed->query(undef);

followed by:

  my $new_uri = parsed->unparse;

the resulting URI will be:

   http://example.com/foo

As mentioned earlier the same goes for return values, so continuing
this example:

  my $new_fragment = $parsed->fragment();
  my $new_query    = $parsed->query();

Both values now contain C<undef>, therefore you must be careful when
using the return values, when you use them, as you may get warnings.

Also make sure you read through C<L<the unparse()
section|/C_unparse_>> as various optional flags affect how the
deparsed URI is rendered.




=head1 API

C<APR::URI> provides the following functions and/or methods:






=head2 C<fragment>

Get/set trailing "#fragment" string

  $oldval = $parsed->fragment($newval);

=over 4

=item obj: C<$parsed>
( C<L<APR::URI object|docs::2.0::api::APR::URI>> )

=item opt arg1: C<$newval> ( string or undef )

=item ret: C<$oldval> ( string or undef )

=item since: 2.0.00

=back






=head2 C<hostinfo>

Get/set combined C<[user[:password]@]host[:port]>

  $oldval = $parsed->hostinfo($newval);

=over 4

=item obj: C<$parsed>
( C<L<APR::URI object|docs::2.0::api::APR::URI>> )

=item opt arg1: C<$newval> ( string or undef )

=item ret: C<$oldval> ( string or undef )

=item since: 2.0.00

=back

The C<hostinfo> value is set automatically when
C<L<parse()|/C_parse_>> is called.

It's not updated if any of the individual fields is modified.

It's not used when C<L<unparse()|/C_unparse_>> is called.






=head2 C<hostname>

Get/set hostname

  $oldval = $parsed->hostname($newval);

=over 4

=item obj: C<$parsed>
( C<L<APR::URI object|docs::2.0::api::APR::URI>> )

=item opt arg1: C<$newval> ( string or undef )

=item ret: C<$oldval> ( string or undef )

=item since: 2.0.00

=back












=head2 C<password>

Get/set password (as in http://user:password@host:port/)

  $oldval = $parsed->password($newval);

=over 4

=item obj: C<$parsed>
( C<L<APR::URI object|docs::2.0::api::APR::URI>> )

=item opt arg1: C<$newval> ( string or undef )

=item ret: C<$oldval> ( string or undef )

=item since: 2.0.00

=back






=head2 C<parse>

Parse the URI string into URI components

  $parsed = APR::URI->parse($pool, $uri);

=over 4

=item obj: C<$parsed>
( C<L<APR::URI object or class|docs::2.0::api::APR::URI>> )

=item arg1: C<$pool> ( string )
( C<L<APR::Pool object|docs::2.0::api::APR::Pool>> )

=item arg2: C<$uri> ( string )

The URI to parse

=item ret: C<$parsed>
( C<L<APR::URI object or class|docs::2.0::api::APR::URI>> )

The parsed URI object

=item since: 2.0.00

=back

After parsing, if a component existed but was an empty string
(e.g. empty query I<http://hostname/path?>) -- the corresponding
accessor will return an empty string. If a component didn't exist
(e.g. no query part I<http://hostname/path>) -- the corresponding
accessor will return C<undef>.




=head2 C<path>

Get/set the request path

  $oldval = $parsed->path($newval);

=over 4

=item obj: C<$parsed>
( C<L<APR::URI object|docs::2.0::api::APR::URI>> )

=item opt arg1: C<$newval> ( string or undef )

=item ret: C<$oldval> ( string or undef )

C<"/"> if only C<scheme://host>

=item since: 2.0.00

=back





=head2 C<rpath>

Gets the C<L<path|/C_path_>> minus the 
C<L<path_info|docs::2.0::api::Apache2::RequestRec/C_path_info_>>

  $rpath =  $parsed->rpath();

=over 4

=item obj: C<$parsed>
( C<L<APR::URI object|docs::2.0::api::APR::URI>> )

=item opt arg1: C<$newval> ( string or undef )

=item ret: C<$oldval> ( string or undef )

The path minus the I<path_info>

=item since: 2.0.00

=back






=head2 C<port>

Get/set port number

  $oldval = $parsed->port($newval);

=over 4

=item obj: C<$parsed>
( C<L<APR::URI object|docs::2.0::api::APR::URI>> )

=item opt arg1: C<$newval> ( number or string or undef )

=item ret: C<$oldval> ( string or undef )

If the port component didn't appear in the parsed URI, APR internally
calls C<L<port_of_scheme()|/C_port_of_scheme_>> to find out the port
number for the given C<L<scheme()|/C_scheme_>>.

=item since: 2.0.00

=back






=head2 C<port_of_scheme>

Return the default port for a given scheme.  The recognized schemes
are http, ftp, https, gopher, wais, nntp, snews and prospero.

  $port = APR::URI::port_of_scheme($scheme);

=over 4

=item obj: C<$scheme> ( string )

The scheme string

=item ret: C<$port> (integer)

The default port for this scheme

=item since: 2.0.00

=back





=head2 C<query>

Get/set the query string (the part starting after C<'?'> and all the
way till the end or the C<'#fragment'> part if the latter exists).

  $oldval = $parsed->query($newval);

=over 4

=item obj: C<$parsed>
( C<L<APR::URI object|docs::2.0::api::APR::URI>> )

=item opt arg1: C<$newval> ( string or undef )

=item ret: C<$oldval> ( string or undef )

=item since: 2.0.00

=back






=head2 C<scheme>

Get/set the protocol scheme ("http", "ftp", ...)

  $oldval = $parsed->scheme($newval);

=over 4

=item obj: C<$parsed>
( C<L<APR::URI object|docs::2.0::api::APR::URI>> )

=item opt arg1: C<$newval> ( string or undef )

=item ret: C<$oldval> ( string or undef )

=item since: 2.0.00

=back





=head2 C<user>

Get/set user name (as in http://user:password@host:port/)

  $oldval = $parsed->user($newval);

=over 4

=item obj: C<$parsed>
( C<L<APR::URI object|docs::2.0::api::APR::URI>> )

=item opt arg1: C<$newval> ( string or undef )

=item ret: C<$oldval> ( string or undef )

=item since: 2.0.00

=back




=head2 C<unparse>

Unparse the URI components back into a URI string

  $new_uri = $parsed->unparse();
  $new_uri = $parsed->unparse($flags);

=over 4

=item obj: C<$parsed>
( C<L<APR::URI object|docs::2.0::api::APR::URI>> )

=item opt arg1: C<$flags> ( L<the APR::Const :uri
constants|docs::2.0::api::APR::Const/C__uri_> )

By default the constant C<APR::Const::URI_UNP_OMITPASSWORD> is passed.

If you need to pass more than one flag use unary C<|>, e.g.:

  $flags = APR::Const::URI_UNP_OMITUSER|APR::Const::URI_UNP_OMITPASSWORD;

The valid C<flags> constants are listed next

=item ret: C<$new_uri> ( string )

=item since: 2.0.00

=back

Valid C<flags> constants:

To import all URI constants you could do:

  use APR::Const -compile => qw(:uri);

but there is a significant amount of them, most irrelevant to this
method. Therefore you probably don't want to do that. Instead specify
explicitly the ones that you need. All the relevant to this method
constants start with C<APR::URI_UNP_>.

And the available constants are:

=over 4

=item C<APR::Const::URI_UNP_OMITSITEPART>

Don't show C<L<scheme|/C_scheme_>>, C<L<user|/C_user_>>,
C<L<password|/C_password_>>, C<L<hostname|/C_hostname_>> and
C<L<port|/C_port_>> components (i.e. if you want only the relative
URI)

=item C<APR::Const::URI_UNP_OMITUSER>

Hide the C<L<user|/C_user_>> component

=item C<APR::Const::URI_UNP_OMITPASSWORD>

Hide the C<L<password|/C_password_>> component (the default)

=item C<APR::Const::URI_UNP_REVEALPASSWORD>

Reveal the C<L<password|/C_password_>> component

=item C<APR::Const::URI_UNP_OMITPATHINFO>

Don't show C<L<path|/C_path_>>, C<L<query|/C_query_>> and
C<L<fragment|/C_fragment_>> components

=item C<APR::Const::URI_UNP_OMITQUERY>

Don't show C<L<query|/C_query_>> and C<L<fragment|/C_fragment_>>
components

=back

Notice that some flags overlap.

If the optional C<$flags> argument is passed and contains no
C<APR::Const::URI_UNP_OMITPASSWORD> and no C<APR::Const::URI_UNP_REVEALPASSWORD> --
the C<L<password|/C_password_>> part will be rendered as a literal
C<"XXXXXXXX"> string.

If the C<L<port|/C_port_>> number matches the
C<L<port_of_scheme()|/C_port_of_scheme_>>, the unparsed URI won't
include it and there is no flag to force that C<L<port|/C_port_>> to
appear. If the C<L<port|/C_port_>> number is non-standard it will show
up in the unparsed string.

Examples:

Starting with the parsed URL:

  use APR::URI ();
  my $url = 'http://user:pass@example.com:80/foo?bar#item5';
  my $parsed = APR::URI->parse($r->pool, $url);

deparse it back including and excluding parts, using different values
for the optional C<flags> argument:

=over 4

=item *

Show all but the C<L<password|/C_password_>> fields:

  print $parsed->unparse;

Prints:

  http://user@example.com/foo?bar#item5

Notice that the C<L<port|/C_port_>> field is gone too, since it was a
default C<L<port|/C_port_of_scheme_>> for C<L<scheme|/C_scheme_>>
C<http://>.

=item *

Include the C<L<password|/C_password_>> field (by default it's not revealed)

  use APR::Const -compile => qw(URI_UNP_REVEALPASSWORD);
  print $parsed->unparse(APR::Const::URI_UNP_REVEALPASSWORD);

Prints:

  http://user:pass@example.com/foo?bar#item5

=item *

Show all fields but the last three, C<L<path|/C_path_>>,
C<L<query|/C_query_>> and C<L<fragment|/C_fragment_>>:

  use APR::Const -compile => qw(URI_UNP_REVEALPASSWORD
                                APR::Const::URI_UNP_OMITPATHINFO);
  print $parsed->unparse(
      APR::Const::URI_UNP_REVEALPASSWORD|URI_UNP_OMITPATHINFO);

Prints:

  http://user:pass@example.com

=back







=head1 See Also

C<L<Apache2::URI|docs::2.0::api::Apache2::URI>>, L<mod_perl 2.0
documentation|docs::2.0::index>.




=head1 Copyright

mod_perl 2.0 and its core modules are copyrighted under
The Apache Software License, Version 2.0.




=head1 Authors

L<The mod_perl development team and numerous
contributors|about::contributors::people>.

=cut

