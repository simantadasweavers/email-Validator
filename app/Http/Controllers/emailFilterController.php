<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Allemails;
use App\Models\Visitors;
use App\Models\Validemails;
use App\Models\Invalidemails;
use DB;

use vendor\autoload;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;



class emailFilterController extends Controller
{
    public function filter(Request $request)
    {

        if (session()->get('visitormail')) {

            $visitormail = session()->get('visitormail');
            $enrollno = Visitors::select('enrollno')->where('email', '=', $visitormail)
                ->first()->enrollno;

            if (!empty($_POST['email'])) {

                $email = $_POST['email'];

                $validator = new EmailValidator();
                $multipleValidations = new MultipleValidationWithAnd([
                    new RFCValidation(),
                    new DNSCheckValidation()
                ]);
                //ietf.org has MX records signaling a server with email capabilities
                $res = $validator->isValid("$email", $multipleValidations); //true

                $mail = $this->disposable($email);
                if($mail == "disposable"){
                    $res = false;
                }

                if ($visitormail) {

                    $all = new Allemails;
                    $all->clientid = $enrollno;
                    $all->name = $email;
                    $all->date = date("Y/m/d");
                    date_default_timezone_set("Asia/Kolkata");
                    $all->time = date("h:i:sa");
                    $all->save();
                    if ($res) {
                        $valid = new Validemails;
                        $valid->clientid = $enrollno;
                        $valid->name = $email;
                        $valid->date = date("Y/m/d");
                        date_default_timezone_set("Asia/Kolkata");
                        $valid->time = date("h:i:sa");
                        $valid->save();
                        echo "<b>" . $email . "</b>" . "<font color='green'> VALID EMAIL </font> <br>";
                    } else {
                        $invalid = new Invalidemails;
                        $invalid->clientid = $enrollno;
                        $invalid->name = $email;
                        $invalid->date = date("Y/m/d");
                        date_default_timezone_set("Asia/Kolkata");
                        $invalid->time = date("h:i:sa");
                        $invalid->save();
                        echo "<b>" . $email . "</b>" . "<font color='red'> INVALID EMAIL </font> <br>";
                    }
                }
            }

        } else {
            return redirect('/');
        }

    }


    public function disposable($mail)
    {
        $emailDomains = ["0-mail.com", "0815.ru", "0clickemail.com", "0wnd.net", "0wnd.org", "10minutemail.com", "20minutemail.com", "2prong.com", "30minutemail.com", "3d-painting.com", "4warding.com", "4warding.net", "4warding.org", "60minutemail.com", "675hosting.com", "675hosting.net", "675hosting.org", "6url.com", "75hosting.com", "75hosting.net", "75hosting.org", "7tags.com", "9ox.net", "a-bc.net", "afrobacon.com", "ajaxapp.net", "amilegit.com", "amiri.net", "amiriindustries.com", "anonbox.net", "anonymbox.com", "antichef.com", "antichef.net", "antispam.de", "baxomale.ht.cx", "beefmilk.com", "binkmail.com", "bio-muesli.net", "bobmail.info", "bodhi.lawlita.com", "bofthew.com", "brefmail.com", "broadbandninja.com", "bsnow.net", "bugmenot.com", "bumpymail.com", "casualdx.com", "centermail.com", "centermail.net", "chogmail.com", "choicemail1.com", "cool.fr.nf", "correo.blogos.net", "cosmorph.com", "courriel.fr.nf", "courrieltemporaire.com", "cubiclink.com", "curryworld.de", "cust.in", "dacoolest.com", "dandikmail.com", "dayrep.com", "deadaddress.com", "deadspam.com", "despam.it", "despammed.com", "devnullmail.com", "dfgh.net", "digitalsanctuary.com", "discardmail.com", "discardmail.de", "Disposableemailaddresses:emailmiser.com", "disposableaddress.com", "disposeamail.com", "disposemail.com", "dispostable.com", "dm.w3internet.co.ukexample.com", "dodgeit.com", "dodgit.com", "dodgit.org", "donemail.ru", "dontreg.com", "dontsendmespam.de", "dump-email.info", "dumpandjunk.com", "dumpmail.de", "dumpyemail.com", "e4ward.com", "email60.com", "emaildienst.de", "emailias.com", "emailigo.de", "emailinfive.com", "emailmiser.com", "emailsensei.com", "emailtemporario.com.br", "emailto.de", "emailwarden.com", "emailx.at.hm", "emailxfer.com", "emz.net", "enterto.com", "ephemail.net", "etranquil.com", "etranquil.net", "etranquil.org", "explodemail.com", "fakeinbox.com", "fakeinformation.com", "fastacura.com", "fastchevy.com", "fastchrysler.com", "fastkawasaki.com", "fastmazda.com", "fastmitsubishi.com", "fastnissan.com", "fastsubaru.com", "fastsuzuki.com", "fasttoyota.com", "fastyamaha.com", "filzmail.com", "fizmail.com", "fr33mail.info", "frapmail.com", "front14.org", "fux0ringduh.com", "garliclife.com", "get1mail.com", "get2mail.fr", "getonemail.com", "getonemail.net", "ghosttexter.de", "girlsundertheinfluence.com", "gishpuppy.com", "gowikibooks.com", "gowikicampus.com", "gowikicars.com", "gowikifilms.com", "gowikigames.com", "gowikimusic.com", "gowikinetwork.com", "gowikitravel.com", "gowikitv.com", "great-host.in", "greensloth.com", "gsrv.co.uk", "guerillamail.biz", "guerillamail.com", "guerillamail.net", "guerillamail.org", "guerrillamail.biz", "guerrillamail.com", "guerrillamail.de", "guerrillamail.net", "guerrillamail.org", "guerrillamailblock.com", "h.mintemail.com", "h8s.org", "haltospam.com", "hatespam.org", "hidemail.de", "hochsitze.com", "hotpop.com", "hulapla.de", "ieatspam.eu", "ieatspam.info", "ihateyoualot.info", "iheartspam.org", "imails.info", "inboxclean.com", "inboxclean.org", "incognitomail.com", "incognitomail.net", "incognitomail.org", "insorg-mail.info", "ipoo.org", "irish2me.com", "iwi.net", "jetable.com", "jetable.fr.nf", "jetable.net", "jetable.org", "jnxjn.com", "junk1e.com", "kasmail.com", "kaspop.com", "keepmymail.com", "killmail.com", "killmail.net", "kir.ch.tc", "klassmaster.com", "klassmaster.net", "klzlk.com", "kulturbetrieb.info", "kurzepost.de", "letthemeatspam.com", "lhsdv.com", "lifebyfood.com", "link2mail.net", "litedrop.com", "lol.ovpn.to", "lookugly.com", "lopl.co.cc", "lortemail.dk", "lr78.com", "m4ilweb.info", "maboard.com", "mail-temporaire.fr", "mail.by", "mail.mezimages.net", "mail2rss.org", "mail333.com", "mail4trash.com", "mailbidon.com", "mailblocks.com", "mailcatch.com", "maileater.com", "mailexpire.com", "mailfreeonline.com", "mailin8r.com", "mailinater.com", "mailinator.com", "mailinator.net", "mailinator2.com", "mailincubator.com", "mailme.ir", "mailme.lv", "mailmetrash.com", "mailmoat.com", "mailnator.com", "mailnesia.com", "mailnull.com", "mailshell.com", "mailsiphon.com", "mailslite.com", "mailzilla.com", "mailzilla.org", "mbx.cc", "mega.zik.dj", "meinspamschutz.de", "meltmail.com", "messagebeamer.de", "mierdamail.com", "mintemail.com", "moburl.com", "moncourrier.fr.nf", "monemail.fr.nf", "monmail.fr.nf", "msa.minsmail.com", "mt2009.com", "mx0.wwwnew.eu", "mycleaninbox.net", "mypartyclip.de", "myphantomemail.com", "myspaceinc.com", "myspaceinc.net", "myspaceinc.org", "myspacepimpedup.com", "myspamless.com", "mytrashmail.com", "neomailbox.com", "nepwk.com", "nervmich.net", "nervtmich.net", "netmails.com", "netmails.net", "netzidiot.de", "neverbox.com", "no-spam.ws", "nobulk.com", "noclickemail.com", "nogmailspam.info", "nomail.xl.cx", "nomail2me.com", "nomorespamemails.com", "nospam.ze.tc", "nospam4.us", "nospamfor.us", "nospamthanks.info", "notmailinator.com", "nowmymail.com", "nurfuerspam.de", "nus.edu.sg", "nwldx.com", "objectmail.com", "obobbo.com", "oneoffemail.com", "onewaymail.com", "online.ms", "oopi.org", "ordinaryamerican.net", "otherinbox.com", "ourklips.com", "outlawspam.com", "ovpn.to", "owlpic.com", "pancakemail.com", "pimpedupmyspace.com", "pjjkp.com", "politikerclub.de", "poofy.org", "pookmail.com", "privacy.net", "proxymail.eu", "prtnx.com", "punkass.com", "PutThisInYourSpamDatabase.com", "qq.com", "quickinbox.com", "rcpt.at", "recode.me", "recursor.net", "regbypass.com", "regbypass.comsafe-mail.net", "rejectmail.com", "rklips.com", "rmqkr.net", "rppkn.com", "rtrtr.com", "s0ny.net", "safe-mail.net", "safersignup.de", "safetymail.info", "safetypost.de", "sandelf.de", "saynotospams.com", "selfdestructingmail.com", "SendSpamHere.com", "sharklasers.com", "shiftmail.com", "shitmail.me", "shortmail.net", "sibmail.com", "skeefmail.com", "slaskpost.se", "slopsbox.com", "smellfear.com", "snakemail.com", "sneakemail.com", "sofimail.com", "sofort-mail.de", "sogetthis.com", "soodonims.com", "spam.la", "spam.su", "spamavert.com", "spambob.com", "spambob.net", "spambob.org", "spambog.com", "spambog.de", "spambog.ru", "spambox.info", "spambox.irishspringrealty.com", "spambox.us", "spamcannon.com", "spamcannon.net", "spamcero.com", "spamcon.org", "spamcorptastic.com", "spamcowboy.com", "spamcowboy.net", "spamcowboy.org", "spamday.com", "spamex.com", "spamfree24.com", "spamfree24.de", "spamfree24.eu", "spamfree24.info", "spamfree24.net", "spamfree24.org", "SpamHereLots.com", "SpamHerePlease.com", "spamhole.com", "spamify.com", "spaminator.de", "spamkill.info", "spaml.com", "spaml.de", "spammotel.com", "spamoff.de", "spamslicer.com", "spamspot.com", "spamthis.co.uk", "spamthisplease.com", "spamtrail.com", "speed.1s.fr", "supergreatmail.com", "supermailer.jp", "suremail.info", "teewars.org", "teleworm.com", "tempalias.com", "tempe-mail.com", "tempemail.biz", "tempemail.com", "TempEMail.net", "tempinbox.co.uk", "tempinbox.com", "tempmail.it", "tempmail2.com", "tempomail.fr", "temporarily.de", "temporarioemail.com.br", "temporaryemail.net", "temporaryforwarding.com", "temporaryinbox.com", "thanksnospam.info", "thankyou2010.com", "thisisnotmyrealemail.com", "throwawayemailaddress.com", "tilien.com", "tmailinator.com", "tradermail.info", "trash-amil.com", "trash-mail.at", "trash-mail.com", "trash-mail.de", "trash2009.com", "trashemail.de", "trashmail.at", "trashmail.com", "trashmail.de", "trashmail.me", "trashmail.net", "trashmail.org", "trashmail.ws", "trashmailer.com", "trashymail.com", "trashymail.net", "trillianpro.com", "turual.com", "twinmail.de", "tyldd.com", "uggsrock.com", "upliftnow.com", "uplipht.com", "venompen.com", "veryrealemail.com", "viditag.com", "viewcastmedia.com", "viewcastmedia.net", "viewcastmedia.org", "webm4il.info", "wegwerfadresse.de", "wegwerfemail.de", "wegwerfmail.de", "wegwerfmail.net", "wegwerfmail.org", "wetrainbayarea.com", "wetrainbayarea.org", "wh4f.org", "whyspam.me", "willselfdestruct.com", "winemaven.info", "wronghead.com", "wuzup.net", "wuzupmail.net", "www.e4ward.com", "www.gishpuppy.com", "www.mailinator.com", "wwwnew.eu", "xagloo.com", "xemaps.com", "xents.com", "xmaily.com", "xoxy.net", "yep.it", "yogamaven.com", "yopmail.com", "yopmail.fr", "yopmail.net", "ypmail.webarnak.fr.eu.org", "yuurok.com", "zehnminutenmail.de", "zippymail.info", "zoaxe.com", "zoemail.org", "0845.ru", "10minutemail.net", "12houremail.com", "12minutemail.com", "1pad.de", "8127ep.com", "agedmail.com", "akapost.com", "akerd.com", "ama-trade.de", "ama-trans.de", "ano-mail.net", "anon-mail.de", "anonmails.de", "antireg.ru", "antispam24.de", "antispammail.de", "armyspy.com", "asdasd.ru", "b2cmail.de", "bio-muesli.info", "blackmarket.to", "bootybay.de", "br.mintemail.com", "breakthru.com", "brennendesreich.de", "bspamfree.org", "buffemail.com", "bugmenever.com", "bund.us", "byom.de", "cam4you.cc", "card.zp.ua", "cellurl.com", "cheatmail.de", "consumerriot.com", "cuvox.de", "dbunker.com", "dealja.com", "delikkt.de", "dingbone.com", "disposableemailaddresses:emailmiser.com", "dotman.de", "dropcake.de", "dropmail.me", "dudmail.com", "duskmail.com", "easytrashmail.com", "edv.to", "einmalmail.de", "einrot.com", "eintagsmail.de", "emailgo.de", "emaillime.com", "emailtemporanea.com", "emailtemporanea.net", "ero-tube.org", "express.net.ua", "eyepaste.com", "fakedemail.com", "fakemail.fr", "fakemailgenerator.com", "fansworldwide.de", "film-blog.biz", "fivemail.de", "fly-ts.de", "flyspam.com", "fudgerub.com", "fyii.de", "garbagemail.org", "gehensiemirnichtaufdensack.de", "geschent.biz", "getairmail.com", "getmails.eu", "giantmail.de", "gmal.com", "gmial.com", "gomail.in", "guerrillamail.info", "hat-geld.de", "hmamail.com", "hotmai.com", "hotmial.com", "humaility.com", "ieh-mail.de", "ignoremail.com", "ikbenspamvrij.nl", "inboxed.im", "inboxed.pw", "infocom.zp.ua", "instant-mail.de", "ip6.li", "is.af", "junk.to", "kostenlosemailadresse.de", "koszmail.pl", "lawlita.com", "linuxmail.so", "llogin.ru", "lolfreak.net", "losemymail.com", "luckymail.org", "m21.cc", "mail.zp.ua", "mail1a.de", "mail21.cc", "mailbiz.biz", "mailde.de", "mailde.info", "maildrop.cc", "maildu.de", "maileimer.de", "mailforspam.com", "mailita.tk", "mailme24.com", "mailms.com", "mailorg.org", "mailscrap.com", "mailseal.de", "mailtome.de", "mailtrash.net", "mailtv.net", "mailtv.tv", "makemetheking.com", "malahov.de", "ministry-of-silly-walks.de", "misterpinball.de", "mt2014.com", "mycard.net.ua", "mysamp.de", "mytempmail.com", "nabuma.com", "nevermail.de", "nincsmail.hu", "nobugmail.com", "nobuma.com", "nomail.pw", "nospammail.net", "odnorazovoe.ru", "ohaaa.de", "omail.pro", "oneoffmail.com", "onlatedotcom.info", "plexolan.de", "powered.name", "privatdemail.net", "privy-mail.de", "privymail.de", "put2.net", "putthisinyourspamdatabase.com", "realtyalerts.ca", "receiveee.com", "rhyta.com", "schafmail.de", "schmeissweg.tk", "shut.name", "smashmail.de", "sofortmail.de", "spam.su", "spamgourmet.com", "spamherelots.com", "spaml.de", "spamlot.net", "spamserver.tk", "spammotel.com", "spamspot.com", "sudolife.me", "tempemail.co.za", "tempemail.com", "tempinbox.co.uk", "tempmailer.com", "temporaryemail.net", "temporaryinbox.com", "thankyou2010.com", "thismail.net", "tmpmail.net", "turboprinz.de", "ugeek.com", "usharingk.com", "web-contact.info", "wefjo.grn.cc", "wegwerfmail.de", "wegwerfmail.net", "wegwerfmail.org", "wh4f.org", "whyspam.me", "willhackforfood.biz", "willselfdestruct.com", "winemaven.info", "xjoi.com", "xpornclub.com", "xyz.am", "yopmail.fr", "yuurok.com", "zehnminuten.de", "zehnminutenmail.de", "zippymail.in", "zomg.info", "0815.ru", "0clickemail.com", "0wnd.net", "0wnd.org", "10minutemail.com", "10minutemail.net", "2prong.com", "30minutemail.com", "30minutemail.com", "4warding.com", "4warding.net", "4warding.org", "5ymail.com", "60minutemail.com", "60minutemail.com", "675hosting.com", "675hosting.net", "675hosting.org", "6url.com", "75hosting.com", "75hosting.net", "75hosting.org", "9ox.net", "a-bc.net", "afrobacon.com", "ajaxapp.net", "amilegit.com", "amiri.net", "amiriindustries.com", "anonmails.de", "anonymbox.com", "antichef.com", "antichef.net", "antispam.de", "armyspy.com", "baxomale.ht.cx", "binkmail.com", "bio-muesli.net", "bobmail.info", "bodhi.lawlita.com", "brefmail.com", "bsnow.net", "bugmenot.com", "bumpymail.com", "casualdx.com", "centermail.com", "centermail.net", "chogmail.com", "choicemail1.com", "cool.fr.nf", "correo.blogos.net", "cosmorph.com", "courriel.fr.nf", "courrieltemporaire.com", "cubiclink.com", "curryworld.de", "cust.in", "dacoolest.com", "dandikmail.com", "dayrep.com", "deadaddress.com", "deadspam.com", "despam.it", "despammed.com", "devnullmail.com", "dfgh.net", "digitalsanctuary.com", "discardmail.com", "discardmail.de", "dm.w3internet.co.uk", "dodgeit.com", "dodgit.com", "dodgit.org", "donemail.ru", "dontreg.com", "dontsendmespam.de", "dump-email.info", "dumpandjunk.com", "dumpmail.de", "dumpyemail.com", "e4ward.com", "email60.com", "emaildienst.de", "emailias.com", "emailigo.de", "emailinfive.com", "emailmiser.com", "emailsensei.com", "emailtemporario.com.br", "emailto.de", "emailwarden.com", "emailx.at.hm", "emailxfer.com", "emz.net", "enterto.com", "ephemail.net", "etranquil.com", "etranquil.net", "etranquil.org", "explodemail.com", "fakeinbox.com", "fakeinformation.com", "fastacura.com", "fastchevy.com", "fastchrysler.com", "fastkawasaki.com", "fastmazda.com", "fastmitsubishi.com", "fastnissan.com", "fastsubaru.com", "fastsuzuki.com", "fasttoyota.com", "fastyamaha.com", "filzmail.com", "fizmail.com", "fr33mail.info", "frapmail.com", "front14.org", "fux0ringduh.com", "garliclife.com", "get1mail.com", "get2mail.fr", "getonemail.com", "getonemail.net", "ghosttexter.de", "girlsundertheinfluence.com", "gishpuppy.com", "gowikibooks.com", "gowikicampus.com", "gowikicars.com", "gowikifilms.com", "gowikigames.com", "gowikimusic.com", "gowikinetwork.com", "gowikitravel.com", "gowikitv.com", "great-host.in", "greensloth.com", "gsrv.co.uk", "guerillamail.biz", "guerillamail.com", "guerillamail.net", "guerillamail.org", "guerrillamail.biz", "guerrillamail.com", "guerrillamail.de", "guerrillamail.net", "guerrillamail.org", "guerrillamailblock.com", "h.mintemail.com", "h8s.org", "haltospam.com", "hatespam.org", "hidemail.de", "hochsitze.com", "hotpop.com", "hulapla.de", "ieatspam.eu", "ieatspam.info", "ihateyoualot.info", "iheartspam.org", "imails.info", "inboxclean.com", "inboxclean.org", "incognitomail.com", "incognitomail.net", "incognitomail.org", "insorg-mail.info", "ipoo.org", "irish2me.com", "iwi.net", "jetable.com", "jetable.fr.nf", "jetable.net", "jetable.org", "jnxjn.com", "junk1e.com", "kasmail.com", "kaspop.com", "keepmymail.com", "killmail.com", "killmail.net", "kir.ch.tc", "klassmaster.com", "klassmaster.net", "klzlk.com", "kulturbetrieb.info", "kurzepost.de", "letthemeatspam.com", "lookugly.com", "lopl.co.cc", "lortemail.dk", "lr78.com", "maboard.com", "mail.mezimages.net", "mail.zp.ua", "mail333.com", "mailbidon.com", "mailblocks.com", "mailcatch.com", "maileater.com", "mailexpire.com", "mailfreeonline.com", "mailin8r.com", "mailinater.com", "mailinator.com", "mailinator.net", "mailinator2.com", "mailincubator.com", "mailme.ir", "mailme.lv", "mailmetrash.com", "mailmoat.com", "mailnator.com", "mailnesia.com", "mailnull.com", "mailshell.com", "mailsiphon.com", "mailslite.com", "mailzilla.com", "mailzilla.org", "mbx.cc", "mega.zik.dj", "meinspamschutz.de", "meltmail.com", "messagebeamer.de", "mierdamail.com", "mintemail.com", "moburl.com", "moncourrier.fr.nf", "monemail.fr.nf", "monmail.fr.nf", "msa.minsmail.com", "mt2009.com", "mx0.wwwnew.eu", "mycleaninbox.net", "mypartyclip.de", "myphantomemail.com", "myspaceinc.com", "myspaceinc.net", "myspaceinc.org", "myspacepimpedup.com", "myspamless.com", "mytrashmail.com", "neomailbox.com", "nepwk.com", "nervmich.net", "nervtmich.net", "netmails.com", "netmails.net", "netzidiot.de", "neverbox.com", "no-spam.ws", "nobulk.com", "noclickemail.com", "nogmailspam.info", "nomail.xl.cx", "nomail2me.com", "nomorespamemails.com", "nospam.ze.tc", "nospam4.us", "nospamfor.us", "nospamthanks.info", "notmailinator.com", "nowmymail.com", "nurfuerspam.de", "nus.edu.sg", "nwldx.com", "objectmail.com", "obobbo.com", "oneoffemail.com", "onewaymail.com", "online.ms", "oopi.org", "ordinaryamerican.net", "otherinbox.com", "ourklips.com", "outlawspam.com", "ovpn.to", "owlpic.com", "pancakemail.com", "pimpedupmyspace.com", "pjjkp.com", "politikerclub.de", "poofy.org", "pookmail.com", "privacy.net", "proxymail.eu", "prtnx.com", "punkass.com", "PutThisInYourSpamDatabase.com", "qq.com", "quickinbox.com", "rcpt.at", "recode.me", "recursor.net", "regbypass.com", "regbypass.comsafe-mail.net", "rejectmail.com", "rklips.com", "rmqkr.net", "rppkn.com", "rtrtr.com", "s0ny.net", "safe-mail.net", "safersignup.de", "safetymail.info", "safetypost.de", "sandelf.de", "saynotospams.com", "selfdestructingmail.com", "SendSpamHere.com", "sharklasers.com", "shiftmail.com", "shitmail.me", "shortmail.net", "sibmail.com", "skeefmail.com", "slaskpost.se", "slopsbox.com", "smellfear.com", "snakemail.com", "sneakemail.com", "sofimail.com", "sofort-mail.de", "sogetthis.com", "soodonims.com", "spam.la", "spam.su", "spamavert.com", "spambob.com", "spambob.net", "spambob.org", "spambog.com", "spambog.de", "spambog.ru", "spambox.info", "spambox.irishspringrealty.com", "spambox.us", "spamcannon.com", "spamcannon.net", "spamcero.com", "spamcon.org", "spamcorptastic.com", "spamcowboy.com", "spamcowboy.net", "spamcowboy.org", "spamday.com", "spamex.com", "spamfree24.com", "spamfree24.de", "spamfree24.eu", "spamfree24.info", "spamfree24.net", "spamfree24.org", "SpamHereLots.com", "SpamHerePlease.com", "spamhole.com", "spamify.com", "spaminator.de", "spamkill.info", "spaml.com", "spaml.de", "spammotel.com", "spamoff.de", "spamslicer.com", "spamspot.com", "spamthis.co.uk", "spamthisplease.com", "spamtrail.com", "speed.1s.fr", "supergreatmail.com", "supermailer.jp", "suremail.info", "teewars.org", "teleworm.com", "tempalias.com", "tempe-mail.com", "tempemail.biz", "tempemail.com", "TempEMail.net", "tempinbox.co.uk", "tempinbox.com", "tempmail.it", "tempmail2.com", "tempomail.fr", "temporarily.de", "temporarioemail.com.br", "temporaryemail.net", "temporaryinbox.com", "temporarymailaddress.com", "tempthe.net", "thanksnospam.info", "thc.st", "thisisnotmyrealemail.com", "throwawayemailaddress.com", "tilien.com", "tittbit.in", "tmailinator.com", "toomail.biz", "topranklist.de", "tradermail.info", "trash-amil.com", "trash-mail.at", "trash-mail.com", "trash-mail.de", "trash2009.com", "trashdevil.com", "trashemail.de", "trashmail.at", "trashmail.com", "trashmail.de", "trashmail.me", "trashmail.net", "trashmail.org", "trashmail.ws", "trashmailer.com", "trashymail.com", "trayna.com", "trbvm.com", "trillianpro.com", "tyldd.com", "uggsrock.com", "upliftnow.com", "uplipht.com", "venompen.com", "veryrealemail.com", "viditag.com", "viewcastmedia.com", "viewcastmedia.net", "viewcastmedia.org", "webm4il.info", "wegwerfadresse.de", "wegwerfemail.de", "wegwerfmail.de", "wegwerfmail.net", "wegwerfmail.org", "wetrainbayarea.com", "wetrainbayarea.org", "wh4f.org", "whyspam.me", "willselfdestruct.com", "winemaven.info", "wronghead.com", "wuzup.net", "wuzupmail.net", "www.e4ward.com", "www.gishpuppy.com", "www.mailinator.com", "wwwnew.eu", "xagloo.com", "xemaps.com", "xents.com", "xmaily.com", "xoxy.net", "yep.it", "yogamaven.com", "yopmail.com", "yopmail.fr", "yopmail.net", "ypmail.webarnak.fr.eu.org", "yuurok.com", "zehnminutenmail.de", "zippymail.info", "zoaxe.com", "zoemail.org", "zomg.info", "zoaxe.com", "zoemail.org"];
        
        // removing the username
        $parts = explode("@", $mail);
        $mail = end($parts);

        if (in_array($mail, $emailDomains)) {
            return "disposable";
        } else {
            return "not disposable";
        }
    }

    // valid email section

    public function validemails(Request $request)
    {
        if (session('visitormail')) {
            $visitormail = session()->get('visitormail');
            $enrollno = Visitors::select('enrollno')->where('email', '=', $visitormail)
                ->first()->enrollno;
            $data = DB::table('validemails')->where('clientid', '=', $enrollno)->get();
            return view('valids', ['mail' => $data]);
        } else {
            return redirect('/');
        }
    }


    public function deletevalidAll()
    {
        if (session()->get('visitormail')) {
            $visitormail = session()->get('visitormail');
            $enrollno = Visitors::select('enrollno')->where('email', '=', $visitormail)->first()->enrollno;
            Validemails::where('clientid', '=', $enrollno)->delete();
            $visitormail = session()->get('visitormail');
            $clientID = Visitors::select('enrollno')->where('email', '=', $visitormail)
                ->first()->enrollno;
            $mails = Validemails::where('clientid', '=', $clientID)->get();
            return view('valids', ['mail' => $mails]);

        } else {
            return redirect('/');
        }
    }

    public function deleteValid(Request $request)
    {
        if (session()->get('visitormail')) {
            $request->validate(['emailid' => 'required']);
            $emailid = $request['emailid'];
            $visitormail = session()->get('visitormail');
            $clientID = Visitors::select('enrollno')->where('email', '=', $visitormail)
                ->first()->enrollno;
            $email = Validemails::where('id', '=', $emailid)->where('clientid', '=', $clientID)
                ->get();
            return view('delete/singleDeletevalid', ['email' => $email]);
        } else {
            return redirect('/');
        }
    }

    public function deleteValidReq(Request $request)
    {
        if (session()->get('visitormail')) {
            $request->validate(['mailid' => 'required']);
            $id = $request['mailid'];
            $visitormail = session()->get('visitormail');
            $clientID = Visitors::select('enrollno')->where('email', '=', $visitormail)
                ->first()->enrollno;
            Validemails::where('id', '=', $id)->where('clientid', '=', $clientID)->delete();
            $mails = Validemails::where('clientid', '=', $clientID)->get();
            return view('valids', ['mail' => $mails]);

        } else {
            return redirect('/');
        }
    }


    // valid email section   

    public function invalids()
    {
        if (session()->get('visitormail')) {

            $visitormail = session()->get('visitormail');
            $clientID = Visitors::select('enrollno')->where('email', '=', $visitormail)
                ->first()->enrollno;
            $mails = Invalidemails::where('clientid', '=', $clientID)->get();
            return view('invalids', ['mail' => $mails]);

        } else {
            return redirect('/');
        }

    }

    public function deleteInvalid(Request $request)
    {
        if (session()->get('visitormail')) {
            $request->validate(['emailid' => 'required']);
            $emailid = $request['emailid'];
            $visitormail = session()->get('visitormail');
            $clientID = Visitors::select('enrollno')->where('email', '=', $visitormail)
                ->first()->enrollno;
            $email = Invalidemails::where('id', '=', $emailid)->where('clientid', '=', $clientID)
                ->get();
            return view('delete/singleDeleteInvalid', ['email' => $email]);
        } else {
            return redirect('/');
        }
    }

    public function deleteInvalidReq(Request $request)
    {
        if (session()->get('visitormail')) {
            $request->validate(['mailid' => 'required']);
            $id = $request['mailid'];
            $visitormail = session()->get('visitormail');
            $clientID = Visitors::select('enrollno')->where('email', '=', $visitormail)
                ->first()->enrollno;
            Invalidemails::where('id', '=', $id)->where('clientid', '=', $clientID)->delete();
            $mails = Invalidemails::where('clientid', '=', $clientID)->get();
            return view('invalids', ['mail' => $mails]);
        } else {
            return redirect('/');
        }
    }

    public function deleteInvalidAll()
    {
        if (session()->get('visitormail')) {
            $visitormail = session()->get('visitormail');
            $clientID = Visitors::select('enrollno')->where('email', '=', $visitormail)
                ->first()->enrollno;
            Invalidemails::where('clientid', '=', $clientID)->delete();
            $mails = Invalidemails::where('clientid', '=', $clientID)->get();
            return view('invalids', ['mail' => $mails]);
        } else {
            return redirect('/');
        }
    }

    public function deleteAllEmails()
    {
        if (session()->get('visitormail')) {
            $visitormail = session()->get('visitormail');
            $clientID = Visitors::select('enrollno')->where('email', '=', $visitormail)
                ->first()->enrollno;
            Allemails::where('clientid', '=', $clientID)->delete();
            $visitormail = session()->get('visitormail');
            $clientID = Visitors::select('enrollno')->where('email', '=', $visitormail)->first()->enrollno;
            $allemails = Allemails::where('clientid', '=', $clientID)->orderBy('emailid', 'DESC')->get()->count();
            $validemails = Validemails::where('clientid', '=', $clientID)->orderBy('id', 'DESC')->get()->count();
            $invaidemails = Invalidemails::where('clientid', '=', $clientID)->orderBy('id', 'DESC')->get()->count();
            $all = Allemails::where('clientid', '=', $clientID)->orderBy('emailid', 'DESC')->get();
            return view('dashboard', ['all' => $all, 'allemail' => $allemails, 'valid' => $validemails, 'invalid' => $invaidemails]);

        } else {
            return redirect('/');
        }
    }


}